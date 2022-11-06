<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;


Route::get('/',[HomeController::class,'index'])->name('/');

Route::get('/visitor',[VisitorController::class,'visitorIndex'])->name('visitor');


// Admin Panel Service Management
Route::get('/service',[ServiceController::class,'serviceIndex'])->name('service');
Route::get('/getServicesData',[ServiceController::class,'getServiceData'])->name('getServicesData');
Route::post('/serviceDelete',[ServiceController::class,'getServiceDelete'])->name('serviceDelete');
Route::post('/serviceDetails',[ServiceController::class,'getServiceDetails'])->name('serviceDetails');
Route::post('/serviceUpdate',[ServiceController::class,'getServiceUpdate'])->name('serviceUpdate');

