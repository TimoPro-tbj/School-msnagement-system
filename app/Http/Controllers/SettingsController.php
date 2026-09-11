<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Schools;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Annoucement;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       public function index()
    {

 return view('settings');
$latestAnnouncement = Annoucement::where('is_active', true)
    ->latest()
    ->value('message');
        $school = Auth::user()->school;

        if (!$school) {
            return redirect()->route('login');
        }
       $user = Auth::user();
        $studentsCount = Students::where('school_id', $school->id)->count();
        $coursesCount = Courses::where('school_id', $school->id)->count();
        $teachersCount = Teachers::where('school_id', $school->id)->count();
        $courses = Courses::where('school_id', $school->id)->get();


        return view('dashboard', compact(
            'coursesCount',
            'studentsCount',
            'teachersCount',
            'courses',
            'school',
            'user',
            'latestAnnouncement',
        ));
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
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
