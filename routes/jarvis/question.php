<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::resource('question', QuestionController::class)->except('create', 'show', 'edit');
Route::post('question/destroy-bulk', [QuestionController::class, 'destroyBulk'])->name('question.destroy-bulk');