<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\QuestionIndexRequest;
use App\Http\Requests\Question\QuestionStoreRequest;
use App\Http\Requests\Question\QuestionUpdateRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:question create', ['only' => ['create', 'store']]);
        $this->middleware('permission:question read', ['only' => ['index', 'show']]);
        $this->middleware('permission:question update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:question delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(QuestionIndexRequest $request)
    {
        $questions = Question::where(['type' => $request->type, 'exam_id' => $request->exam_id]);
        if ($request->has('search')) {
            $questions->where('question', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $questions->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Question/Index', [
            'title'         => "Soal",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'type'          => $request->type,
            'exam_id'       => $request->exam_id,
            'questions'   => $questions->with('user')->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => "Soal", 'href' => route('question.index')]],
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
    public function store(QuestionStoreRequest $request)
    {
        try {
            $question = Question::create([
                'user_id' => auth()->user()->id,
                'exam_id' => $request->exam_id,
                'type' => $request->type,
                'question' => $request->question,
                'a' => $request->a,
                'b' => $request->b,
                'c' => $request->c,
                'd' => $request->d,
                'e' => $request->e,
                'key' => $request->key,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => 'Soal']));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => 'Soal']) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        try {
            $question->update([
                'user_id' => auth()->user()->id,
                'exam_id' => $request->exam_id,
                'type' => $request->type,
                'question' => $request->question,
                'a' => $request->a,
                'b' => $request->b,
                'c' => $request->c,
                'd' => $request->d,
                'e' => $request->e,
                'key' => $request->key,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => 'Soal']));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => 'Soal']) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        try {
            $question->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => 'Soal']));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => 'Soal']) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $questions = Question::whereIn('id', $request->id);
            $questions->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Soal"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Soal"]) . $th->getMessage());
        }
    }
}
