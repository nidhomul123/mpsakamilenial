<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        return Inertia::render('Guest/Profile', [
            'title' => 'Profil',
            'member' => Member::find(auth()->guard('member')->user()->id),
            'grades' => Grade::orderBy('name')->get(),
        ]);
    }
    public function update(MemberUpdateRequest $request, Member $member)
    {
        try {
            if ($request->image != null) {
                Storage::delete('public/image/member/' . $member->image);
                $image = time() . "." . $request->image->extension();
                Storage::put('public/image/member/' . $image, File::get($request->image), 'public');
            } else {
                $image = $member->image;
            }
            if ($request->card != null) {
                Storage::delete('public/image/member-card/' . $member->card);
                $card = time() . "." . $request->card->extension();
                Storage::put('public/image/member-card/' . $card, File::get($request->card), 'public');
            } else {
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
            ]);
            return back()->with('success', __('app.label.updated_successfully', ['name' => "Profil"]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.updated_error', ['name' => "Profil"]) . $th->getMessage());
        }
    }
}
