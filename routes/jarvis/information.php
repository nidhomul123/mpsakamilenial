<?php

use App\Http\Controllers\InformationController;
use Illuminate\Support\Facades\Route;

Route::resource('information', InformationController::class)->except('create', 'show', 'edit');
Route::post('information/destroy-bulk', [InformationController::class, 'destroyBulk'])->name('information.destroy-bulk');