<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberAuthRequest;
use App\Http\Requests\Member\MemberStoreRequest;
use App\Models\Grade;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::guard('member')->check()) {
            return to_route('guest.member');
        }
        return Inertia::render('Guest/Auth/Login', [
            'title' => 'Login Anggota'
        ]);
    }

    public function handleLogin(MemberAuthRequest $request)
    {
        $member = Member::where('email', $request->email);
        $status = $member->first()->status;
        if ($member->where('status', 'diterima')->count() == 0) {
            throw ValidationException::withMessages([
                'email' => 'Status akun anda masih ' . strtoupper($status) . ' silahkan hubungi admin untuk info lebih lanjut',
            ]);
        }
        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'diterima'], $request->remember)) {
            return redirect()->intended('/member');
        }
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    public function register()
    {
        if (Auth::guard('member')->check()) {
            return to_route('guest.member');
        }
        return Inertia::render('Guest/Auth/Register', [
            'title' => 'Daftar Anggota',
            'grades' => Grade::orderBy('name')->get(),
        ]);
    }

    public function handleRegister(MemberStoreRequest $request)
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
            ]);
            Session::flash('flash.text', 'Berhasil mendaftar anggota. Selanjutnya status pendaftaran akan dikirm ke email anda.');
            Session::flash('flash.style', 'info');
            return to_route('guest.member.login');
        } catch (\Throwable $th) {
            Session::flash('flash.text', 'Ups! Sepertinya ada yang salah. ' . $th->getCode());
            Session::flash('flash.style', 'error');
            return back();
        }
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route('index');
    }
}
