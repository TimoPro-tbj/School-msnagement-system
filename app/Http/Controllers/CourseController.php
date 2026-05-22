<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Teachers;

class CourseController extends Controller
{
    public function index()
    {
        $school = Auth::user()->school;
        if(!$school){
            return redirect('login');
        }
        $course = Courses::where('school_id',
        $school->id)->orderBy('created_at', 'desc')->get();

        return view('show.courseshow', compact('course', 'school'));
    }
     public function create()
    {
        return view('create.courses');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'course_name' => 'required|string|max:255'
        ]);
       $courses = Courses::create([
         'course_name'=>$request->course_name,
         'school_id'=>Auth::id(),
         'teacher_name'=>'Timothy',
        ]);
        return redirect('/dashboard');
    }
    
    public function edit(Courses $course)
    {
        return view('editplace.edit', compact('course'));
    }

}
