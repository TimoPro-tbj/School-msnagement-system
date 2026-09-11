<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Smalot\PdfParser\Parser;

class StudentsController extends Controller
{
    public function create()
    {
        return view('create.students');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('bulk_file')) {
            $request->validate([
                'bulk_file' => 'required|file|mimes:csv,xlsx,xls,pdf|max:5120',
            ]);

            $file = $request->file('bulk_file');
            $ext = $file->getClientOriginalExtension();

            // ✅ Handle CSV/Excel
            if (in_array($ext, ['csv','xlsx','xls'])) {
                $rows = Excel::toArray([], $file)[0];
                foreach ($rows as $row) {
                    Students::create([
                        'name' => $row['name'] ?? $row[0] ?? null,
                        'course' => $row['course'] ?? $row[1] ?? null,
                        'school_id' => Auth::user()->school_id,
                        'image_path' => null,
                    ]);
                }
            }

            if ($ext === 'pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($file->getRealPath());
                $lines = explode("\n", $pdf->getText());

                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '') continue;

                    if (strpos($line, ',') !== false) {
                        $parts = explode(',', $line);
                        $studentName = $parts[0] ?? null;
                        $course = $parts[1] ?? null;
                    } else {
                        $parts = preg_split('/\s+/', $line);
                        $studentName = $parts[0] . ' ' . ($parts[1] ?? '');
                        $course = $parts[2] ?? 'Unknown';
                    }

                    Students::create([
                        'name' => trim($studentName),
                        'course' => trim($course),
                        'school_id' => Auth::user()->school_id,
                        'image_path' => null,
                    ]);
                }
            }

            return redirect('/dashboard')->with('success', 'Bulk students added successfully!');
        }

        $validated = $request->validate([
            'course' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = Students::create([
            'course' => $validated['course'],
            'name' => $validated['name'],
            'school_id' => Auth::user()->school_id,
            'image_path' => null,
        ]);

        if ($request->hasFile('image_path')) {
            $folderPath = "students/id_{$student->id}/assets";
            $imagePath = $request->file('image_path')->store($folderPath, 'public');
            $student->update(['image_path' => $imagePath]);
        }

        return redirect('/dashboard')->with('success', 'Student added successfully!');
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

        return redirect('/students/show')->with('success', 'Student updated successfully!');
    }

    public function destroy(Students $student)
    {
        if ($student->image_path && Storage::disk('public')->exists($student->image_path)) {
            Storage::disk('public')->delete($student->image_path);
        }
        $student->delete();

        return redirect('/students/show')->with('success', 'Student deleted successfully!');
    }
}
