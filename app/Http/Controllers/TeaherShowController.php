<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Schools;
use App\Models\Courses;
use App\Models\Teachers;

class TeaherShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $school = Auth::user()->school;
        if(!$school){
            return redirect('login');
        }

        $teacher = Teachers::where('school_id', $school->id)->orderBy('created_at', 'desc')->get();
       $courses = Courses::where('school_id', $school->id)->get();
        return view('show.teachershow',
       compact('teacher','school','courses')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teachers $teacher)
    {
        return view('editplace.edit',compact('teacher'),[
            'teachers' => $teacher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
