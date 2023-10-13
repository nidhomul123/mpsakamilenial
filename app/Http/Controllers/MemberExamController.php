<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberExam\MemberExamIndexRequest;
use App\Http\Requests\MemberExam\MemberExamStoreRequest;
use App\Http\Requests\MemberExam\MemberExamUpdateRequest;
use App\Models\ExamAnswer;
use App\Models\MemberExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class MemberExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:memberexam create', ['only' => ['create', 'store']]);
        $this->middleware('permission:memberexam read', ['only' => ['index', 'show']]);
        $this->middleware('permission:memberexam update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:memberexam delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(MemberExamIndexRequest $request)
    {
        $memberexams = MemberExam::query();
        if ($request->has('search')) {
            // $memberexams->where('name', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $memberexams->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('MemberExam/Index', [
            'title'         => "Hasil Penilaian",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'memberexams'   => $memberexams->with('member', 'member.grade', 'exam', 'examAnswers', 'examAnswers.question')->orderBy('created_at', 'desc')->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => "Hasil Penilaian", 'href' => route('memberexam.index')]],
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
    public function store(MemberExamStoreRequest $request)
    {
        try {
            $memberexam = MemberExam::create([
                'user_id'   => auth()->user()->id,
                'name'      => $request->name,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => "Hasil Penilaian"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => 'MemberExam']) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberExam $memberexam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberExam $memberexam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberExamUpdateRequest $request, MemberExam $memberexam)
    {
        try {
            $memberexam->update([
                'user_id'   => auth()->user()->id,
                'name'      => $request->name,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => "Hasil Penilaian"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => "Hasil Penilaian"]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberExam $memberexam)
    {
        try {
            $memberexam->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => "Hasil Penilaian"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => "Hasil Penilaian"]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $memberexams = MemberExam::whereIn('id', $request->id);
            $memberexams->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Hasil Penilaian"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Hasil Penilaian"]) . $th->getMessage());
        }
    }

    public function correction(MemberExam $memberExam)
    {
        return Inertia::render('MemberExam/Correction', [
            'title'         => "Koreksi Penilaian",
            'memberexam'   => MemberExam::whereId($memberExam->id)->with('member', 'member.grade', 'exam', 'examAnswers', 'examAnswers.question')->orderBy('created_at', 'desc')->firstOrFail(),
            'breadcrumbs'   => [['label' => "Koreksi Penilaian", 'href' => route('memberexam.correction', ['memberExam' => $memberExam->id])]],
        ]);
    }

    public function saveCorrection(Request $request)
    {
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->multiple_choice); $i++) {
                ExamAnswer::where(['id' => $request->multiple_choice[$i]['id']])->update([
                    'user_id' => auth()->user()->id,
                    'score' => $request->multiple_choice[$i]['score']
                ]);
            }
            for ($i = 0; $i < count($request->essay); $i++) {
                ExamAnswer::where(['id' => $request->essay[$i]['id']])->update([
                    'user_id' => auth()->user()->id,
                    'score' => $request->essay[$i]['score']
                ]);
            }
            DB::commit();
            Session::flash('flash.text', 'Berhasil mengoreksi penilaian');
            Session::flash('flash.style', 'success');
            return to_route('memberexam.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Session::flash('flash.text', 'Gagal mengoreksi penilaian : ' . $th->getMessage());
            Session::flash('flash.style', 'info');
            return to_route('memberexam.index');
        }
    }
}
