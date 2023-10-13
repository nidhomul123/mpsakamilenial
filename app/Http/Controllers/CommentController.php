<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentIndexRequest;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:comment create', ['only' => ['create', 'store']]);
        $this->middleware('permission:comment read', ['only' => ['index', 'show']]);
        $this->middleware('permission:comment update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:comment delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CommentIndexRequest $request)
    {
        $comments = Comment::query();
        if ($request->has('search')) {
            $comments->where('name', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $comments->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Comment/Index', [
            'title'         => "Comment",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'comments'   => $comments->with('user')->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => "Comment", 'href' => route('comment.index')]],
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
    public function store(CommentStoreRequest $request)
    {
        try {
            $comment = Comment::create([
                'user_id'       => $request->user_id,
                'member_id'     => $request->member_id,
                'subject_id'    => $request->subject_id,
                'text'          => $request->text,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => 'Komentar']));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => 'Comment']) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        try {
            $comment->update([
                'user_id'   => auth()->user()->id,
                'name'      => $request->name,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => 'Komentar']));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => 'Komentar']) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => 'Komentar']));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => 'Komentar']) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $comments = Comment::whereIn('id', $request->id);
            $comments->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Comment"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Comment"]) . $th->getMessage());
        }
    }
}
