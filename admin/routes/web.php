<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;


Route::get('/',[HomeController::class,'index'])->name('/');
Route::get('/visitor',[VisitorController::class,'visitorIndex'])->name('visitor');
