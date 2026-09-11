<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Courses;
use Maatwebsite\Excel\Facades\Excel;
use Smalot\PdfParser\Parser;

class CourseController extends Controller
{
    public function index()
    {
        $school = Auth::user()->school;
        if (!$school) {
            return redirect('login');
        }

        $course = Courses::where('school_id', $school->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('show.courseshow', compact('course', 'school'));
    }

    public function create()
    {
        return view('create.courses');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('bulk_file')) {
            $request->validate([
                'bulk_file' => 'required|file|mimes:csv,xlsx,xls,pdf|max:5120',
            ]);

            $file = $request->file('bulk_file');
            $ext = $file->getClientOriginalExtension();
            $school = Auth::user()->school;

            if (in_array($ext, ['csv', 'xlsx', 'xls'])) {
                $rows = Excel::toArray([], $file)[0];
                foreach ($rows as $row) {
                    Courses::create([
                        'course_name' => $row['course_name'] ?? $row[0] ?? null,
                        'school_id'   => $school->id,
                        'teacher_name'=> $row['teacher_name'] ?? 'Unknown',
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
                        $courseName = $parts[0] ?? null;
                        $teacherName = $parts[1] ?? 'Unknown';
                    } else {
                        $parts = preg_split('/\s+/', $line);
                        $courseName = $parts[0] ?? null;
                        $teacherName = $parts[1] ?? 'Unknown';
                    }

                    Courses::create([
                        'course_name' => $courseName,
                        'school_id'   => $school->id,
                        'teacher_name'=> $teacherName,
                    ]);
                }
            }

            return redirect('/dashboard')->with('success', 'Bulk courses added successfully!');
        }

        $request->validate([
            'course_name' => 'required|string|max:255'
        ]);

        $school = Auth::user()->school;

        Courses::create([
            'course_name' => $request->course_name,
            'school_id'   => $school->id,
            'teacher_name'=> 'Timothy', // default
        ]);

        return redirect('/dashboard')->with('success', 'Course created successfully.');
    }

    public function edit(Courses $course)
    {
        return view('editplace.edit', compact('course'));
    }
}
