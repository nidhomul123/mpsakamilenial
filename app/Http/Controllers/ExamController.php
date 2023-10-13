<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exam\ExamIndexRequest;
use App\Http\Requests\Exam\ExamStoreRequest;
use App\Http\Requests\Exam\ExamUpdateRequest;
use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:exam create', ['only' => ['create', 'store']]);
        $this->middleware('permission:exam read', ['only' => ['index', 'show']]);
        $this->middleware('permission:exam update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:exam delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ExamIndexRequest $request)
    {
        $exams = Exam::query();
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
        return Inertia::render('Exam/Index', [
            'title'         => "Penilaian",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'exams'         => $exams->with('user', 'grade', 'multiples', 'essays')->paginate($perPage)->onEachSide(0),
            'grades'        => Grade::orderBy('name')->get(),
            'breadcrumbs'   => [['label' => "Penilaian", 'href' => route('exam.index')]],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamStoreRequest $request)
    {
        try {
            $exam = Exam::create([
                'user_id' => auth()->user()->id,
                'grade_id' => $request->grade_id,
                'title' => $request->title,
                'time' => $request->time,
                'information' => $request->information,
                'passing_grade' => $request->passing_grade,
                'multiple_choice' => $request->multiple_choice,
                'essay' => $request->essay,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => $exam->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => 'Penilaian']) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamUpdateRequest $request, Exam $exam)
    {
        try {
            $exam->update([
                'user_id' => auth()->user()->id,
                'grade_id' => $request->grade_id,
                'title' => $request->title,
                'time' => $request->time,
                'information' => $request->information,
                'passing_grade' => $request->passing_grade,
                'multiple_choice' => $request->multiple_choice,
                'essay' => $request->essay,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => $exam->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => $exam->title]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        try {
            $exam->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $exam->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => $exam->title]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $exams = Exam::whereIn('id', $request->id);
            $exams->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Penilaian"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Penilaian"]) . $th->getMessage());
        }
    }
}
