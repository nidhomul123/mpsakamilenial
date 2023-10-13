<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::resource('grade', GradeController::class)->except('create', 'show', 'edit');
Route::post('grade/destroy-bulk', [GradeController::class, 'destroyBulk'])->name('grade.destroy-bulk');