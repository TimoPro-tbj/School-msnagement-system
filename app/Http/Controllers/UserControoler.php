<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Schools;
use App\Models\User;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Annoucement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserControoler extends Controller
{
   public function dashboard()
{
    $latestAnnouncement = Annoucement::where('is_active', true)
        ->latest()
        ->value('message');

    $school = Auth::user()->school;

    if (!$school) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    $studentsCount = Students::where('school_id', $school->id)->count();
    $coursesCount  = Courses::where('school_id', $school->id)->count();
    $teachersCount = Teachers::where('school_id', $school->id)->count();

    $courses  = Courses::where('school_id', $school->id)->get();
    $teachers = Teachers::where('school_id', $school->id)->get();
    $students = Students::where('school_id', $school->id)->get();

    return view('dashboard', compact(
        'coursesCount',
        'studentsCount',
        'teachersCount',
        'courses',
        'teachers',
        'students',
        'school',
        'user',
        'latestAnnouncement',
    ));
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school = Auth::user()->school;
          return view('nav', compact(
            'school',
        ));

    }

 /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('register');
     }

     public function store(Request $request)  {
  $request->validate([
    'schoolname' => ['required', 'string','max:75'],
    'schoolcode' => ['required','string','max:20','unique:schools,schoolcode'],
    'email'      => ['required','string','min:5','unique:users'],
    'password'   => ['required','min:6'],
    'badge_path' => ['nullable','mimes:jpeg,png,jpg,gif','max:2049'],
]);



      $school = Schools::create([
    'schoolname' => $request->schoolname,
    'schoolcode' => $request->schoolcode,   // user sets this
    'badge_path' => $request->badge_path,
]);

        $user = User::create([
    'name'      => $request->schoolname . ' Admin',
    'email'     => $request->email,
    'password'  => bcrypt($request->password),
     'school_id' => null, 
      'role'      => 'admin',
]);

        \Illuminate\Support\Facades\Auth::login($user);
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schools $schools)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schools $schools)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schools $schools)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schools $schools)
    {
        //
    }
}
