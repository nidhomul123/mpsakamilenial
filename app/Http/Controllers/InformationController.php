<?php

namespace App\Http\Controllers;

use App\Http\Requests\Information\InformationIndexRequest;
use App\Http\Requests\Information\InformationStoreRequest;
use App\Http\Requests\Information\InformationUpdateRequest;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:information create', ['only' => ['create', 'store']]);
        $this->middleware('permission:information read', ['only' => ['index', 'show']]);
        $this->middleware('permission:information update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:information delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(InformationIndexRequest $request)
    {
        $informations = Information::query();
        if ($request->has('search')) {
            $informations->where('title', 'LIKE', "%" . $request->search . "%");
            $informations->orWhere('date', 'LIKE', "%" . $request->search . "%");
            $informations->orWhere('published', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $informations->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Information/Index', [
            'title'         => "Informasi",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'information'   => $informations->with('user')->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => "Informasi", 'href' => route('information.index')]],
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
    public function store(InformationStoreRequest $request)
    {
        try {
            $image = time() . "." . $request->image->extension();
            Storage::put('public/image/information/' . $image, File::get($request->image), 'public');
            $information = Information::create([
                'user_id'   => auth()->user()->id,
                'title'     => $request->title,
                'image'     => $image,
                'text'      => $request->text,
                'date'      => $request->date,
                'published' => $request->published,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => $information->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => 'Informasi']) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformationUpdateRequest $request, Information $information)
    {
        try {
            if ($request->image != null) {
                Storage::delete('public/image/information/' . $information->image);
                $image = time() . "." . $request->image->extension();
                Storage::put('public/image/information/' . $image, File::get($request->image), 'public');
            }else{
                $image = $information->image;
            }
            $information->update([
                'user_id'   => auth()->user()->id,
                'title'     => $request->title,
                'image'     => $image,
                'text'      => $request->text,
                'date'      => $request->date,
                'published' => $request->published,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => $information->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => $information->title]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        try {
            Storage::delete('public/image/information/' . $information->image);
            $information->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $information->title]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => $information->title]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $informations = Information::whereIn('id', $request->id);
            foreach ($informations->get() as $information) {
                Storage::delete('public/image/information/' . $information->image);
            }
            $informations->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Informasi"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Informasi"]) . $th->getMessage());
        }
    }
}
