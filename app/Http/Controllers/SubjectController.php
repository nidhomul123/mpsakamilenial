<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\SubjectIndexRequest;
use App\Http\Requests\Subject\SubjectStoreRequest;
use App\Http\Requests\Subject\SubjectUpdateRequest;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:subject create', ['only' => ['create', 'store']]);
        $this->middleware('permission:subject read', ['only' => ['index', 'show']]);
        $this->middleware('permission:subject update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:subject delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SubjectIndexRequest $request)
    {
        $subjects = Subject::query();
        if ($request->has('search')) {
            $subjects->where('title', 'LIKE', "%" . $request->search . "%");
            $subjects->orWhere('slug', 'LIKE', "%" . $request->search . "%");
            $subjects->orWhere('description', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $subjects->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Subject/Index', [
            'title'         => "Materi",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'subjects'   => $subjects->with('user', 'grade', 'comments')->paginate($perPage)->onEachSide(0),
            'grades'        => Grade::orderBy('name')->get(),
            'breadcrumbs'   => [['label' => "Materi", 'href' => route('subject.index')]],
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
    public function store(SubjectStoreRequest $request)
    {
        try {
            $image = time() . "." . $request->image->extension();
            Storage::put('public/image/subject/' . $image, File::get($request->image), 'public');
            $subject = Subject::create([
                'user_id'       => auth()->user()->id,
                'grade_id'      => $request->grade_id,
                'title'         => $request->title,
                'image'         => $image,
                'description'   => $request->description,
                'subject'       => $request->subject,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => $subject->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => 'Subject']) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return Inertia::render('Subject/Detail', [
            'title' => "Detail Materi",
            'subject' => Subject::with('user', 'grade', 'comments', 'comments.user', 'comments.member')->where('id', $subject->id)->first(),
            'breadcrumbs'   => [
                ['label' => "Materi", 'href' => route('subject.index')],
                ['label' => "Detail Materi", 'href' => route('subject.index')]
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectUpdateRequest $request, Subject $subject)
    {
        try {
            if ($request->image != null) {
                Storage::delete('public/image/subject/' . $subject->image);
                $image = time() . "." . $request->image->extension();
                Storage::put('public/image/subject/' . $image, File::get($request->image), 'public');
            } else {
                $image = $subject->image;
            }
            $subject->update([
                'user_id'       => auth()->user()->id,
                'grade_id'      => $request->grade_id,
                'title'         => $request->title,
                'image'         => $image,
                'description'   => $request->description,
                'subject'       => $request->subject,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => $subject->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => $subject->title]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        try {
            Storage::delete('public/image/subject/' . $subject->image);
            $subject->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $subject->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => $subject->title]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $subjects = Subject::whereIn('id', $request->id);
            foreach ($subjects->get() as $subject) {
                Storage::delete('public/image/subject/' . $subject->image);
            }
            $subjects->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Materi"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Materi"]) . $th->getMessage());
        }
    }
}
