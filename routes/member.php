<?php

use App\Http\Controllers\Guest\AuthController;
use App\Http\Controllers\Guest\ExamController;
use App\Http\Controllers\Guest\InformationController;
use App\Http\Controllers\Guest\MemberController;
use App\Http\Controllers\Guest\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/member/login', [AuthController::class, 'login'])->name('guest.member.login');
Route::get('/member/register', [AuthController::class, 'register'])->name('guest.member.register');
Route::post('/member/login', [AuthController::class, 'handleLogin'])->name('guest.member.handle-login');
Route::post('/member/register', [AuthController::class, 'handleRegister'])->name('guest.member.handle-register');

Route::get('/information', [InformationController::class, 'index'])->name('guest.information');
Route::get('/information/{slug}', [InformationController::class, 'detail'])->name('guest.information-detail');

Route::prefix('member')->middleware(['authmember'])->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('guest.member');
    Route::put('/member/update/member/{member}', [MemberController::class, 'update'])->name('guest.member-update');

    Route::get('/subject', [SubjectController::class, 'index'])->name('guest.subject');
    Route::get('/subject/{slug}', [SubjectController::class, 'detail'])->name('guest.subject-detail');

    Route::get('/exam', [ExamController::class, 'index'])->name('guest.exam');
    Route::get('/exam/start/{slug}', [ExamController::class, 'startExam'])->name('guest.exam-start');
    Route::get('/exam/{slug}', [ExamController::class, 'exam'])->name('guest.exam-index');
    Route::post('/exam/save', [ExamController::class, 'saveAnswer'])->name('guest.exam-save');
    Route::get('/result', [ExamController::class, 'result'])->name('guest.exam-result');
    Route::get('/end/{memberExam}', [ExamController::class, 'end'])->name('guest.exam-end');

    Route::post('/member/logout', [AuthController::class, 'logout'])->name('guest.member.logout');
});
