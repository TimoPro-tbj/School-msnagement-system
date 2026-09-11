<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use App\Models\Courses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as Controllers;

class TeachersDashboardController extends Controllers
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:teacher');
    }

    public function index()
    {
        $user   = Auth::user();
        $school = $user->school;

        $teacher = Teachers::where('email', $user->email)
                           ->where('school_id', $school->id)
                           ->first();

        if (!$teacher) {
            return redirect('/dashboard')->with('error', 'No teacher record found.');
        }

        $courses = Courses::where('school_id', $school->id)
                          ->where('teacher_name', $teacher->teacher_name)
                          ->get();

        return view('dashboard.teacher', [
            'teacher' => $teacher,
            'courses' => $courses,
            'school'  => $school,
        ]);
    }
}
