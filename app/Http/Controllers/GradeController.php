<?php

namespace App\Http\Controllers;

use App\Http\Requests\Grade\GradeIndexRequest;
use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Requests\Grade\GradeUpdateRequest;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:grade create', ['only' => ['create', 'store']]);
        $this->middleware('permission:grade read', ['only' => ['index', 'show']]);
        $this->middleware('permission:grade update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:grade delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(GradeIndexRequest $request)
    {
        $grades = Grade::query();
        if ($request->has('search')) {
            $grades->where('name', 'LIKE', "%" . $request->search . "%");
            $grades->orWhere('slug', 'LIKE', "%" . $request->search . "%");
            $grades->orWhere('description', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $grades->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Grade/Index', [
            'title'         => "Krida",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'grades'   => $grades->with('user')->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => "Krida", 'href' => route('grade.index')]],
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
    public function store(GradeStoreRequest $request)
    {
        try {
            $image = time() . "." . $request->image->extension();
            Storage::put('public/image/grade/' . $image, File::get($request->image), 'public');
            $grade = Grade::create([
                'user_id'       => auth()->user()->id,
                'name'          => $request->name,
                'image'         => $image,
                'description'   => $request->description,
                'curriculum'    => $request->curriculum,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => $grade->name]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => "Krida"]) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeUpdateRequest $request, Grade $grade)
    {
        try {
            if ($request->image != null) {
                Storage::delete('public/image/grade/' . $grade->image);
                $image = time() . "." . $request->image->extension();
                Storage::put('public/image/grade/' . $image, File::get($request->image), 'public');
            } else {
                $image = $grade->image;
            }
            $grade->update([
                'user_id'   => auth()->user()->id,
                'name'          => $request->name,
                'image'         => $image,
                'description'   => $request->description,
                'curriculum'    => $request->curriculum,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => $grade->name]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => $grade->name]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        try {
            Storage::delete('public/image/grade/' . $grade->image);
            $grade->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $grade->name]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => $grade->name]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $grades = Grade::whereIn('id', $request->id);
            foreach ($grades->get() as $grade) {
                Storage::delete('public/image/grade/' . $grade->image);
            }
            $grades->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Krida"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Krida"]) . $th->getMessage());
        }
    }
}
