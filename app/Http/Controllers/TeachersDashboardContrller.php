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
        $this->middleware('role:teacher'); // only teachers can access
    }

    public function index()
    {
        $user   = Auth::user();
        $school = $user->school;

        // Find teacher record by email + school
        $teacher = Teachers::where('email', $user->email)
                           ->where('school_id', $school->id)
                           ->first();

        if (!$teacher) {
            return redirect('/dashboard')->with('error', 'No teacher record found.');
        }

        // Courses taught by this teacher (match teacher_name in courses table)
        $courses = Courses::where('school_id', $school->id)
                          ->where('teacher_name', $teacher->teacher_name)
                          ->get();

        // Students are not in your schema yet, so we’ll just show courses for now
        return view('dashboard.teacher', [
            'teacher' => $teacher,
            'courses' => $courses,
            'school'  => $school,
        ]);
    }
}
