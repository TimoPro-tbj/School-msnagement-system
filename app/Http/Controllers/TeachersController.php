<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create.teachers');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
          'course' => 'required|string|max:255',
          'teacher_name' => 'required|string|max:255',
           'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2049',
        ]);
             $teacher = Teachers::create([
         'course'=>$request->course,
         'teacher_name'=>$request->teacher_name,
         'image_path'=>null,
         'school_id'=>Auth::id(),
        ]);
        if($request->hasFile('image_path')){
           $folderPath = "teachers/id_{$teacher->id}/assets";
           $imagePath = $request->file('image_path')->store($folderPath, 'public');

           $teacher->update([
            'image_path' =>$imagePath
           ]);
        }
        return redirect('/dashboard');
         return back()->withErrors([
      'course' => 'The provided credetials do not match our records'
     ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teachers $teacher)
    {
        return view('editplace.teachersedit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teachers $teacher)
    {
         $validated = $request->validate([
            'course' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($teacher->image_path && Storage::disk('public')->exists($teacher->image_path)) {
                Storage::disk('public')->delete($teacher->image_path);
            }

            $folderPath = "students/id_{$teacher->id}/assets";
            $imagePath = $request->file('image_path')->store($folderPath, 'public');

            $teacher->image_path = $imagePath;
        }

        $teacher->teacher_name = $validated['teacher_name'];
        $teacher->course = $validated['course'];
        $teacher->save();

        return redirect('/teachers/show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teachers $teacher)
    {
            if ($teacher->image_path && Storage::disk('public')->exists($teacher->image_path)) {
                Storage::disk('public')->delete($teacher->image_path);
            }
            $teacher->delete();

            return redirect('/teachers/show');
    }
}
