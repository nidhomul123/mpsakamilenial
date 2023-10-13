<?php

use App\Http\Controllers\MemberExamController;
use Illuminate\Support\Facades\Route;

Route::resource('memberexam', MemberExamController::class)->except('create', 'show', 'edit');
Route::post('memberexam/destroy-bulk', [MemberExamController::class, 'destroyBulk'])->name('memberexam.destroy-bulk');
Route::get('memberexam/correction/{memberExam}', [MemberExamController::class, 'correction'])->name('memberexam.correction');
Route::post('memberexam/save-correction', [MemberExamController::class, 'saveCorrection'])->name('memberexam.save-correction');
