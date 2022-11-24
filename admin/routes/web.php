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
use App\Http\Controllers\PhotoController;


Route::get('/',[HomeController::class,'index'])->name('/')->middleware('loginCheck');

Route::get('/visitor',[VisitorController::class,'visitorIndex'])->name('visitor')->middleware('loginCheck');


// Admin Panel Service Management
Route::get('/service',[ServiceController::class,'serviceIndex'])->name('service')->middleware('loginCheck');
Route::get('/getServicesData',[ServiceController::class,'getServiceData'])->name('getServicesData')->middleware('loginCheck');
Route::post('/serviceDelete',[ServiceController::class,'getServiceDelete'])->name('serviceDelete')->middleware('loginCheck');
Route::post('/serviceDetails',[ServiceController::class,'getServiceDetails'])->name('serviceDetails')->middleware('loginCheck');
Route::post('/serviceUpdate',[ServiceController::class,'getServiceUpdate'])->name('serviceUpdate')->middleware('loginCheck');
Route::post('/serviceAdd',[ServiceController::class,'getServiceAdd'])->name('serviceAdd')->middleware('loginCheck');


// Admin Panel Courses Management
Route::get('/courses',[CoursesController::class,'coursesIndex'])->name('courses')->middleware('loginCheck');
Route::get('/getCoursesData',[CoursesController::class,'getCoursesData'])->name('getCoursesData')->middleware('loginCheck');
Route::post('/coursesDelete',[CoursesController::class,'getCoursesDelete'])->name('coursesDelete')->middleware('loginCheck');
Route::post('/coursesDetails',[CoursesController::class,'getCoursesDetails'])->name('coursesDetails')->middleware('loginCheck');
Route::post('/coursesUpdate',[CoursesController::class,'getCoursesUpdate'])->name('coursesUpdate')->middleware('loginCheck');
Route::post('/coursesAdd',[CoursesController::class,'getCoursesAdd'])->name('coursesAdd')->middleware('loginCheck');


// Admin Panel Project Management
Route::get('/projects',[ProjectController::class,'projectsIndex'])->name('projects')->middleware('loginCheck');
Route::get('/getProjectsData',[ProjectController::class,'getProjectsData'])->name('getProjectsData')->middleware('loginCheck');
Route::post('/projectsDelete',[ProjectController::class,'getProjectsDelete'])->name('projectsDelete')->middleware('loginCheck');
Route::post('/projectsDetails',[ProjectController::class,'getProjectsDetails'])->name('projectsDetails')->middleware('loginCheck');
Route::post('/projectsUpdate',[ProjectController::class,'getProjectsUpdate'])->name('projectsUpdate')->middleware('loginCheck');
Route::post('/projectsAdd',[ProjectController::class,'getProjectsAdd'])->name('projectsAdd')->middleware('loginCheck');


// Admin Panel Contact Management
Route::get('/contacts',[ContactController::class,'contactsIndex'])->name('contacts')->middleware('loginCheck');
Route::get('/contactsData',[ContactController::class,'getContactsData'])->name('contactsData')->middleware('loginCheck');
Route::post('/contactsDelete',[ContactController::class,'getContactsDelete'])->name('contactsDelete')->middleware('loginCheck');


// Admin Panel Review Management
Route::get('/reviews',[ReviewController::class,'reviewsIndex'])->name('reviews')->middleware('loginCheck');
Route::get('/reviewsData',[ReviewController::class,'getReviewsData'])->name('reviewsData')->middleware('loginCheck');
Route::post('/reviewsDelete',[ReviewController::class,'getReviewsDelete'])->name('reviewsDelete')->middleware('loginCheck');
Route::post('/reviewsDetails',[ReviewController::class,'getReviewsDetails'])->name('reviewsDetails')->middleware('loginCheck');
Route::post('/reviewsUpdate',[ReviewController::class,'getReviewsUpdate'])->name('reviewsUpdate')->middleware('loginCheck');
Route::post('/reviewsAdd',[ReviewController::class,'getReviewsAdd'])->name('reviewsAdd')->middleware('loginCheck');


// Admin Panel login Management
Route::get('/login',[LoginController::class,'loginIndex'])->name('login');
Route::post('/onLogin',[LoginController::class,'onLogin'])->name('onLogin');
Route::get('/logout',[LoginController::class,'onLogout'])->name('logout');


// Admin Panel Photo Gallery
Route::get('/photo',[PhotoController::class,'photoIndex'])->name('photo')->middleware('loginCheck');
Route::post('/photoUpload',[PhotoController::class,'photoUpload'])->name('photoUpload')->middleware('loginCheck');
Route::get('/photoJson',[PhotoController::class,'photoJson'])->name('photoJson')->middleware('loginCheck');
Route::get('/photoJsonId/{id}',[PhotoController::class,'photoJsonById'])->name('photoJsonId')->middleware('loginCheck');
Route::post('/photoDelete',[PhotoController::class,'photoDelete'])->name('photoDelete')->middleware('loginCheck');
