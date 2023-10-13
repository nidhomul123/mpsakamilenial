<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::resource('member', MemberController::class)->except('create', 'show', 'edit');
Route::post('member/destroy-bulk', [MemberController::class, 'destroyBulk'])->name('member.destroy-bulk');