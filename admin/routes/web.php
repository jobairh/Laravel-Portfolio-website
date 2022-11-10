<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;


Route::get('/',[HomeController::class,'index'])->name('/');

Route::get('/visitor',[VisitorController::class,'visitorIndex'])->name('visitor');


// Admin Panel Service Management
Route::get('/service',[ServiceController::class,'serviceIndex'])->name('service');
Route::get('/getServicesData',[ServiceController::class,'getServiceData'])->name('getServicesData');
Route::post('/serviceDelete',[ServiceController::class,'getServiceDelete'])->name('serviceDelete');
Route::post('/serviceDetails',[ServiceController::class,'getServiceDetails'])->name('serviceDetails');
Route::post('/serviceUpdate',[ServiceController::class,'getServiceUpdate'])->name('serviceUpdate');
Route::post('/serviceAdd',[ServiceController::class,'getServiceAdd'])->name('serviceAdd');

// Admin Panel Courses Management
Route::get('/courses',[CoursesController::class,'coursesIndex'])->name('courses');
Route::get('/getCoursesData',[CoursesController::class,'getCoursesData'])->name('getCoursesData');
Route::post('/coursesDelete',[CoursesController::class,'getCoursesDelete'])->name('coursesDelete');
Route::post('/coursesDetails',[CoursesController::class,'getCoursesDetails'])->name('coursesDetails');
Route::post('/coursesUpdate',[CoursesController::class,'getCoursesUpdate'])->name('coursesUpdate');
Route::post('/coursesAdd',[CoursesController::class,'getCoursesAdd'])->name('coursesAdd');

