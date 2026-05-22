<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\Schools;
use App\Http\Controllers\SchoolsRegisterController;
use App\Http\Controllers\UserControoler;
use App\Http\Controllers\LoginAndOutController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\CourseController;
use App\Models\User;
use GuzzleHttp\Middleware;
use App\Http\Controllers\TeaherShowController;
use App\Http\Controllers\StudentsShowController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/feature', function () {
    return view('feature');
})->name('feature');
Route::get('/about', function () {
    return view('about');
})->name('feature');
Route::middleware('auth')->group(function () {
Route::get('/dashboard',[UserControoler::class, 'dashboard'])->name('dashboard');
Route::get('/nav',[UserControoler::class, 'index']);

Route::post('/teachers/create/teacher',[TeachersController::class, 'store']);
Route::post('/courses/create/course',[CourseController::class, 'store']);
Route::post('/students/create/student',[StudentsController::class, 'store']);

Route::get('/students/show',[StudentsShowController::class, 'index'])->name('students.show');
Route::get('/teachers/show',[TeaherShowController::class, 'index'])->name('teachers.show');
Route::get('/courses/show',[CourseController::class, 'index'])->name('courses.show');
Route::get('/{teacher}/edit',[TeaherShowController::class, 'edit']);
Route::get('/{student}/student/edit',[StudentsController::class, 'edit']);
Route::get('/{course}/course/edit',[CourseController::class, 'edit']);
Route::patch('/{student}/student/update',[StudentsController::class, 'update']);
Route::get('/{teacher}/teacher/edit',[TeachersController::class, 'edit']);
Route::patch('/{teacher}/teacher/update',[TeachersController::class, 'update']);
Route::delete('/{teacher}/teacher/delete',[TeachersController::class, 'destroy']);
Route::delete('/{student}/student/delete',[StudentsController::class, 'destroy']);

});
Route::get('/register', [SchoolsRegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [SchoolsRegisterController::class, 'store'])->middleware('guest');


Route::get('/login', [LoginAndOutController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginAndOutController::class, 'store'])->middleware('guest');



//logout
Route::delete('/logout', [LoginAndOutController::class, 'destroy']);



