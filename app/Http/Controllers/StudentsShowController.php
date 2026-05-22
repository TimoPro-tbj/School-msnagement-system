<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Schools;
use App\Models\Courses;
use Illuminate\Support\Facades\Storage;

class StudentsShowController extends Controller
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

        $student = Students::where('school_id',
        $school->id)->orderBy('created_at', 'desc')->get();

        return view('show.studentshow', compact('student', 'school'));
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
    public function edit(students $student)
    {
         return view('editplace.studentsedit',compact('student'),[
            'students' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Students::findOrFail($id);
  
          $request->validate([
         'course' => 'required|string|max:255',
         'name' => 'required|string|max:255',
         'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2049',
        ]);
         if($request->hasFile('image_path')){
          if($student->image_path && Storage::exists($student->image_path)){
            Storage::delete($student->image_path);
          }
          $folderPath = "students/id_{$student->id}/assets";
           $imagePath = $request->file('image_path')->store($folderPath, 'public');
          
           $student->image_path = $imagePath;
        }
        $student->name = $request->name;
        $student->course = $request->course;
     
        return view('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Students $student)
    {
            if ($student->image_path && Storage::disk('public')->exists($student->image_path)) {
                Storage::disk('public')->delete($student->image_path);
            }
            $student->delete();

            return redirect('/students/show');
    }
}
