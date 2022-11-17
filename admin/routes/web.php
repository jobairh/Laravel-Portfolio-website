<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;


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


// Admin Panel Project Management
Route::get('/projects',[ProjectController::class,'projectsIndex'])->name('projects');
Route::get('/getProjectsData',[ProjectController::class,'getProjectsData'])->name('getProjectsData');
Route::post('/projectsDelete',[ProjectController::class,'getProjectsDelete'])->name('projectsDelete');
Route::post('/projectsDetails',[ProjectController::class,'getProjectsDetails'])->name('projectsDetails');
Route::post('/projectsUpdate',[ProjectController::class,'getProjectsUpdate'])->name('projectsUpdate');
Route::post('/projectsAdd',[ProjectController::class,'getProjectsAdd'])->name('projectsAdd');


// Admin Panel Contact Management
Route::get('/contacts',[ContactController::class,'contactsIndex'])->name('contacts');
Route::get('/contactsData',[ContactController::class,'getContactsData'])->name('contactsData');
Route::post('/contactsDelete',[ContactController::class,'getContactsDelete'])->name('contactsDelete');


// Admin Panel Review Management
Route::get('/reviews',[ReviewController::class,'reviewsIndex'])->name('reviews');
Route::get('/reviewsData',[ReviewController::class,'getReviewsData'])->name('reviewsData');
Route::post('/reviewsDelete',[ReviewController::class,'getReviewsDelete'])->name('reviewsDelete');
Route::post('/reviewsDetails',[ReviewController::class,'getReviewsDetails'])->name('reviewsDetails');
Route::post('/reviewsUpdate',[ReviewController::class,'getReviewsUpdate'])->name('reviewsUpdate');
Route::post('/reviewsAdd',[ReviewController::class,'getReviewsAdd'])->name('reviewsAdd');


// login panel
Route::get('/login',[LoginController::class,'loginIndex'])->name('login');
Route::post('/onLogin',[LoginController::class,'onLogin'])->name('onLogin');


