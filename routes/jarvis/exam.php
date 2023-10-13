<?php

use App\Http\Controllers\ExamController;
use Illuminate\Support\Facades\Route;

Route::resource('exam', ExamController::class)->except('create', 'show', 'edit');
Route::post('exam/destroy-bulk', [ExamController::class, 'destroyBulk'])->name('exam.destroy-bulk');