<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::resource('subject', SubjectController::class)->except('create', 'edit');
Route::post('subject/destroy-bulk', [SubjectController::class, 'destroyBulk'])->name('subject.destroy-bulk');
