<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::resource('comment', CommentController::class)->except('create', 'show', 'edit');
Route::post('comment/destroy-bulk', [CommentController::class, 'destroyBulk'])->name('comment.destroy-bulk');