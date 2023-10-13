<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MemberExamController;
use App\Http\Requests\Exam\ExamIndexRequest;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\Question;
use App\Models\MemberExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function index(ExamIndexRequest $request)
    {
        $exams = Exam::where(['grade_id' => auth()->guard('member')->user()->grade_id]);
        if ($request->has('search')) {
            $exams->where('title', 'LIKE', "%" . $request->search . "%");
            $exams->orWhere('time', 'LIKE', "%" . $request->search . "%");
            $exams->orWhere('information', 'LIKE', "%" . $request->search . "%");
            $exams->orWhere('passing_grade', 'LIKE', "%" . $request->search . "%");
            $exams->orWhere('multiple_choice', 'LIKE', "%" . $request->search . "%");
            $exams->orWhere('essay', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $exams->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Guest/Exam', [
            'title'         => "Penilaian",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'exams'         => $exams->with('user', 'grade', 'multiples', 'essays')->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => "Penilaian", 'href' => route('exam.index')]],
        ]);
    }


    public function result(Request $request)
    {
        $memberexams = MemberExam::query();
        if ($request->has('search')) {
            // $memberexams->where('name', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $memberexams->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Guest/ExamResult', [
            'title'         => "Hasil Penilaian",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'memberexams'   => $memberexams->with('member', 'member.grade', 'exam', 'examAnswers', 'examAnswers.question')->latest()->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => "Hasil Penilaian", 'href' => route('memberexam.index')]],
        ]);
    }

    public function startExam($slug)
    {
        $exam = Exam::where(['slug' => $slug])->firstOrFail();
        $start = now();
        $end = Carbon::parse($start)->addMinutes($exam->time);
        $studentExam = MemberExam::create([
            'member_id' => auth()->guard('member')->user()->id,
            'exam_id' => $exam->id,
            'start' => $start,
            'end' => $end
        ]);
        $questions = Question::where(['exam_id' => $exam->id])->get();
        foreach ($questions as $question) {
            ExamAnswer::create([
                'member_exam_id' => $studentExam->id,
                'question_id' => $question->id,
                'answer' => null,
                'score' => 0,
            ]);
        }
        return to_route('guest.exam-index', ['slug' => $exam->slug, 'member_exam_id' => $studentExam->id]);
    }

    public function exam(Request $request, $slug)
    {
        $exam = Exam::where(['slug' => $slug])->firstOrFail();
        $studentExam = MemberExam::where(['id' => $request->member_exam_id, 'member_id' => auth()->guard('member')->user()->id])->firstOrFail();

        if (Carbon::parse($studentExam->end)->isPast()) {
            Session::flash('flash.text', 'Waktu anda sudah habis');
            Session::flash('flash.style', 'info');
            return to_route('guest.exam-result');
        }

        $seconds = ($exam->time * 60) - Carbon::parse($studentExam->start)->diffInSeconds(Carbon::now());
        return Inertia::render('Guest/ExamStart', [
            'title' => $exam->title,
            'exam'  => $exam,
            'seconds' => $seconds,
            'studentExam' => $studentExam,
            'questions' => ExamAnswer::with('question')->join('questions', 'exam_answers.question_id', '=', 'questions.id')->where(['member_exam_id' => $studentExam->id])->orderBy('questions.type')->paginate(1),
            'question_maps' => ExamAnswer::with('question')->join('questions', 'exam_answers.question_id', '=', 'questions.id')->where(['member_exam_id' => $studentExam->id])->orderBy('questions.type')->get(),
        ]);
    }

    public function saveAnswer(Request $request)
    {
        $this->validate($request, [
            'answer' => ['required']
        ]);
        try {
            $question = Question::find($request->question_id)->first();
            $score = 0;
            if ($question->type == 'Multiple Choice') {
                if ($question->key == $request->answer) {
                    $score = 10;
                }
            }
            ExamAnswer::where([
                'member_exam_id' => $request->member_exam_id,
                'question_id' => $request->question_id
            ])->update([
                'answer' => $request->answer,
                'score' => $score
            ]);
            return back()->with('success', "Jawaban berhasil disimpan");
        } catch (\Throwable $th) {
            return back()->with('error', "Jawaban gagal disimpan" . $th->getMessage());
        }
    }

    public function end(MemberExam $memberExam)
    {
        if (!Carbon::parse($memberExam->end)->isPast()) {
            $memberExam->update([
                'end' => Carbon::now()
            ]);
        }
        Session::flash('flash.text', 'Anda telah menyelesaikan penilaian');
        Session::flash('flash.style', 'info');
        return to_route('guest.exam-result');
    }
}
