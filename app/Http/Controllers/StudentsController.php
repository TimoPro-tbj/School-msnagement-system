<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    public function create()
    {
        return view('create.students');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = Students::create([
            'course' => $validated['course'],
            'name' => $validated['name'],
            'image_path' => null,
            'school_id' => Auth::id(),
        ]);

        if ($request->hasFile('image_path')) {
            $folderPath = "students/id_{$student->id}/assets";
            $imagePath = $request->file('image_path')->store($folderPath, 'public');

            $student->update([
                'image_path' => $imagePath,
            ]);
        }

        return redirect('/dashboard');
    }

    public function edit(Students $student)
    {
        return view('editplace.studentsedit', compact('student'));
    }

    public function update(Request $request, Students $student)
    {
        $validated = $request->validate([
            'course' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($student->image_path && Storage::disk('public')->exists($student->image_path)) {
                Storage::disk('public')->delete($student->image_path);
            }

            $folderPath = "students/id_{$student->id}/assets";
            $imagePath = $request->file('image_path')->store($folderPath, 'public');

            $student->image_path = $imagePath;
        }

        $student->name = $validated['name'];
        $student->course = $validated['course'];
        $student->save();

        return redirect('/students/show');
    }
       public function destroy(Students $student)
    {
            if ($student->image_path && Storage::disk('public')->exists($student->image_path)) {
                Storage::disk('public')->delete($student->image_path);
            }
            $student->delete();

            return redirect('/students/show');
    }
}
