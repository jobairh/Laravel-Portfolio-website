<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;


Route::get('/',[HomeController::class,'index'])->name('/');
Route::get('/visitor',[VisitorController::class,'visitorIndex'])->name('visitor');
Route::get('/service',[ServiceController::class,'serviceIndex'])->name('service');
Route::get('/getServicesData',[ServiceController::class,'getServiceData'])->name('getServicesData');
Route::post('/serviceDelete',[ServiceController::class,'serviceDelete'])->name('serviceDelete');
