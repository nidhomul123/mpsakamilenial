<?php

namespace App\Http\Controllers;

use App\Http\Requests\Member\MemberIndexRequest;
use App\Http\Requests\Member\MemberStoreRequest;
use App\Http\Requests\Member\MemberUpdateRequest;
use App\Models\Grade;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:member create', ['only' => ['create', 'store']]);
        $this->middleware('permission:member read', ['only' => ['index', 'show']]);
        $this->middleware('permission:member update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:member delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(MemberIndexRequest $request)
    {
        $members = Member::query();
        if ($request->has('search')) {
            $members->where('name', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $members->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Member/Index', [
            'title'         => "Anggota",
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'members'       => $members->with('grade')->paginate($perPage)->onEachSide(0),
            'grades'        => Grade::orderBy('name')->get(),
            'breadcrumbs'   => [['label' => "Anggota", 'href' => route('member.index')]],
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
    public function store(MemberStoreRequest $request)
    {
        try {
            $image = time() . "." . $request->image->extension();
            Storage::put('public/image/member/' . $image, File::get($request->image), 'public');
            $card = time() . "." . $request->card->extension();
            Storage::put('public/image/member-card/' . $card, File::get($request->card), 'public');
            $member = Member::create([
                'grade_id' => $request->grade_id,
                'name' => $request->name,
                'image' => $image,
                'card' => $card,
                'email' => $request->email,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'gudep' => $request->gudep,
                'kwarran' => $request->kwarran,
                'number_id' => $request->number_id,
                'level' => $request->level,
                'address' => $request->address,
                'phone' => $request->phone,
                'instagram' => $request->instagram,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            ]);
            return back()->with('success', __('app.label.created_successfully', ['name' => $member->name]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.created_error', ['name' => 'Member']) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberUpdateRequest $request, Member $member)
    {
        try {
            if ($request->image != null) {
                Storage::delete('public/image/member/' . $member->image);
                $image = time() . "." . $request->image->extension();
                Storage::put('public/image/member/' . $image, File::get($request->image), 'public');
            }else{
                $image = $member->image;
            }
            if ($request->card != null) {
                Storage::delete('public/image/member-card/' . $member->card);
                $card = time() . "." . $request->card->extension();
                Storage::put('public/image/member-card/' . $card, File::get($request->card), 'public');
            }else{
                $card = $member->card;
            }
            $member->update([
                'grade_id' => $request->grade_id,
                'name' => $request->name,
                'image' => $image,
                'card' => $card,
                'email' => $request->email,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'gudep' => $request->gudep,
                'kwarran' => $request->kwarran,
                'number_id' => $request->number_id,
                'level' => $request->level,
                'address' => $request->address,
                'phone' => $request->phone,
                'instagram' => $request->instagram,
                'password'  => $request->password ? Hash::make($request->password) : $member->password,
                'status' => $request->status,
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => $member->name]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => $member->name]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        try {
            Storage::delete('public/image/member/' . $member->image);
            Storage::delete('public/image/member-card/' . $member->card);
            $member->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $member->name]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => $member->name]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $members = Member::whereIn('id', $request->id);
            foreach ($members->get() as $member) {
                Storage::delete('public/image/member/' . $member->image);
                Storage::delete('public/image/member-card/' . $member->card);
            }
            $members->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . "Anggota"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . "Anggota"]) . $th->getMessage());
        }
    }
}
