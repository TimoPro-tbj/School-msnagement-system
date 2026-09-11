<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Announcements;
use App\Http\Controllers\SchoolsRegisterController;
use App\Http\Controllers\UserControoler;
use App\Http\Controllers\LoginAndOutController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TeaherShowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordChange;
use App\Http\Controllers\StudentsShowController;
use Barryvdh\DomPDF\Facade\Pdf;
use Smalot\PdfParser\Parser;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/feature', fn() => view('feature'))->name('feature');
Route::get('/about', fn() => view('about'))->name('about');

Route::get('/password/change', [PasswordChange::class, 'showChangeForm'])
    ->name('password.change')
    ->middleware('auth');

// Handle the update request
Route::post('/password/update', [PasswordChange::class, 'update'])
    ->name('password.update')
    ->middleware('auth');Route::get('/register', [SchoolsRegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [SchoolsRegisterController::class, 'store'])->middleware('guest');
Route::get('/register-school', [SchoolsRegisterController::class, 'showSchoolForm'])->name('register.school');
Route::post('/register-school', [SchoolsRegisterController::class, 'storeSchool']); 
Route::get('/login', [LoginAndOutController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginAndOutController::class, 'store'])->middleware('guest');
Route::delete('/logout', [LoginAndOutController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Utility / Test Routes
|--------------------------------------------------------------------------
*/
Route::get('/test-pdf', function () {
    $parser = new Parser();
    $pdf = $parser->parseFile(storage_path('app/test.pdf'));
    return nl2br($pdf->getText());
});

Route::get('/teachers/pdf-test', function () {
    $students = [];
    for ($i = 1; $i <= 100; $i++) {
        $students[] = [
            'name'   => "student $i",
            'course' => "Course " . rand(1, 10),
            'grade'  => random_int(1, 100),
        ];
    }

    $pdf = Pdf::loadView('pdf.teachers', compact('students'));
    return $pdf->download('students_test.pdf');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Shared dashboard for all roles
    Route::get('/dashboard', [UserControoler::class, 'dashboard'])->name('dashboard');
    Route::get('/nav', [UserControoler::class, 'index']);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    /*
    |--------------------------------------------------------------------------
    | Admin-only Routes
    |--------------------------------------------------------------------------
    */
     Route::middleware(['auth', 'can:isAdmin'])->group(function (){
        Route::get('/admin/dashboard', [Announcements::class, 'index']);
        Route::post('/admin/promote', [AdminController::class, 'promote']);
        Route::get('/admin/actions/export', [AdminController::class, 'exportActions']);
        Route::post('/admin', [Announcements::class, 'store']);
        Route::get('/admin/create', [Announcements::class, 'create']);

        // Manage teachers
        Route::post('/teachers/create/teacher', [TeachersController::class, 'store']);
        Route::get('/teachers/show', [TeaherShowController::class, 'index'])->name('teachers.show');
        Route::get('/{teacher}/teacher/edit', [TeachersController::class, 'edit']);
        Route::patch('/{teacher}/teacher/update', [TeachersController::class, 'update']);
        Route::delete('/{teacher}/teacher/delete', [TeachersController::class, 'destroy']);

        // Manage students
        Route::post('/students/create/student', [StudentsController::class, 'store']);
        Route::get('/students/show', [StudentsShowController::class, 'index'])->name('students.show');
        Route::get('/{student}/student/edit', [StudentsController::class, 'edit']);
        Route::patch('/{student}/student/update', [StudentsController::class, 'update']);
        Route::delete('/{student}/student/delete', [StudentsController::class, 'destroy']);

        // Manage courses
        Route::post('/courses/create/course', [CourseController::class, 'store']);
        Route::get('/courses/show', [CourseController::class, 'index'])->name('courses.show');
        Route::get('/{course}/course/edit', [CourseController::class, 'edit']);
        Route::get('/admin/actions', [AdminController::class, 'actionsIndex'])->name('admin.actions.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Teacher-only Routes
    |--------------------------------------------------------------------------
    */
   Route::middleware(['auth', 'can:isTeacher'])->group(function () {
        Route::get('/teacher-dashboard', [TeachersController::class, 'view']);
        // Add teacher-specific routes here
    });

});
