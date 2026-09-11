<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Smalot\PdfParser\Parser;
use Illuminate\Routing\Controller as BaseController;

class TeachersController extends BaseController
{
    public function view()
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
    // Everyone can view teachers list
    public function index()
    {
        $school = Auth::user()->school;
        $teachers = Teachers::where('school_id', $school->id)->get();
        return view('teachers.index', compact('teachers'));
    }

    // Admin-only: show create form
    public function create()
    {
        return view('create.teachers');
    }

    // Admin-only: store teacher (single + bulk)
    public function store(Request $request)
    {
        $request->validate([
            'course'       => 'nullable|string|max:255',
            'teacher_name' => 'nullable|string|max:255',
            'image_path'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bulk_file'    => 'nullable|file|mimes:csv,xlsx,xls,pdf|max:5120',
            'email'        => 'nullable|email|max:255',
        ]);

        $school = Auth::user()->school;

        // ✅ Single teacher
        if ($request->filled('teacher_name') && $request->filled('course')) {
            DB::transaction(function () use ($request, $school) {
                $teacher = Teachers::create([
                    'course'       => $request->course,
                    'teacher_name' => $request->teacher_name,
                    'school_id'    => $school->id,
                    'image_path'   => null,
                    'email'        => $request->email,
                ]);

                if ($request->hasFile('image_path')) {
                    $folderPath = "teachers/id_{$teacher->id}/assets";
                    $imagePath = $request->file('image_path')->store($folderPath, 'public');
                    $teacher->update(['image_path' => $imagePath]);
                }

                // Optional: create login account
                if ($request->filled('email')) {
                    User::create([
                        'school_id' => $school->id,
                        'name'      => $teacher->teacher_name,
                        'email'     => $teacher->email,
                        'password'  => bcrypt('defaultPassword123'),
                        'role'      => 'teacher',
                    ]);
                }
            });
        }

        // ✅ Bulk upload
        if ($request->hasFile('bulk_file')) {
            $file = $request->file('bulk_file');
            $ext  = $file->getClientOriginalExtension();

            // CSV/Excel
            if (in_array($ext, ['csv','xlsx','xls'])) {
                $rows = Excel::toArray([], $file)[0];
                foreach ($rows as $row) {
                    if (!empty($row['teacher_name']) && !empty($row['course'])) {
                        $teacher = Teachers::create([
                            'teacher_name' => $row['teacher_name'],
                            'course'       => $row['course'],
                            'school_id'    => $school->id,
                            'email'        => $row['email'] ?? null,
                        ]);

                        if (!empty($row['email'])) {
                            User::create([
                                'school_id' => $school->id,
                                'name'      => $teacher->teacher_name,
                                'email'     => $teacher->email,
                                'password'  => bcrypt('defaultPassword123'),
                                'role'      => 'teacher',
                            ]);
                        }
                    }
                }
            }

// PDF
if ($ext === 'pdf') {
    $parser = new Parser();
    $pdf    = $parser->parseFile($file->getRealPath());
    $lines  = explode("\n", $pdf->getText());

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') continue;

        $teacherName = null;
        $course      = null;
        $email       = null;

        if (strpos($line, ',') !== false) {
            $parts = explode(',', $line);
            $teacherName = $parts[0] ?? null;
            $course      = $parts[1] ?? 'Unknown';
            $email       = $parts[2] ?? null;
        } else {
            $parts       = preg_split('/\s+/', $line);
            $teacherName = $parts[0] . ' ' . ($parts[1] ?? '');
            $course      = $parts[2] ?? 'Unknown';
            $email       = $parts[3] ?? null;
        }

        $teacher = Teachers::create([
            'teacher_name' => trim($teacherName),
            'course'       => trim($course),
            'school_id'    => $school->id,
            'email'        => $email,
        ]);

        if (!empty($email)) {
            User::create([
                'school_id' => $school->id,
                'name'      => $teacher->teacher_name,
                'email'     => $teacher->email,
                'password'  => bcrypt('defaultPassword123'),
                'role'      => 'teacher',
            ]);
        }
    }
}
        }

        return redirect('/dashboard')->with('success', 'Teachers added successfully!');
    }

    // Admin-only: edit teacher
    public function edit(Teachers $teacher)
    {
        return view('editplace.teachersedit', compact('teacher'));
    }

    // Admin-only: update teacher
    public function update(Request $request, Teachers $teacher)
    {
        $validated = $request->validate([
            'course'       => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'image_path'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($teacher->image_path && Storage::disk('public')->exists($teacher->image_path)) {
                Storage::disk('public')->delete($teacher->image_path);
            }

            $folderPath = "teachers/id_{$teacher->id}/assets";
            $imagePath = $request->file('image_path')->store($folderPath, 'public');
            $teacher->image_path = $imagePath;
        }

        $teacher->teacher_name = $validated['teacher_name'];
        $teacher->course       = $validated['course'];
        $teacher->save();

        return redirect('/teachers/show');
    }

    // Admin-only: delete teacher
    public function destroy(Teachers $teacher)
    {
        if ($teacher->image_path && Storage::disk('public')->exists($teacher->image_path)) {
            Storage::disk('public')->delete($teacher->image_path);
        }
        $teacher->delete();

        return redirect('/teachers/show');
    }
}
