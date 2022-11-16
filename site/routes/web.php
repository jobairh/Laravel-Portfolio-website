<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('/');

Route::post('/contact',[HomeController::class,'contactSend'])->name('contact');


Route::get('/courses',[CoursesController::class,'coursePage'])->name('courses');
Route::get('/projects',[ProjectsController::class,'projectsPage'])->name('projects');
Route::get('/policy',[PolicyController::class,'policyPage'])->name('policy');
Route::get('/terms',[TermsController::class,'termsPage'])->name('terms');
Route::get('/contact',[ContactController::class,'contactPage'])->name('contact');

