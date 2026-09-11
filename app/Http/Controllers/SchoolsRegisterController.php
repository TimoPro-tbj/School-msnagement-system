<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schools;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SchoolsRegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

public function store(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'admin', 
       'school_id' => null,
    ]);

Auth::login($user); 
$request->session()->regenerate(); 

    return view('register-school')
                     ->with('info', 'Account created! Now register your school.');
}

public function showSchoolForm() {
    return view('register-school');
}

public function storeSchool(Request $request) {
    if (Schools::where('schoolcode', $request->schoolcode)->exists()) {
    return back()->withErrors(['schoolcode' => 'This school code is already taken.']);
}
   $school = Schools::create([
                'schoolname' => $request->schoolname,
                'schoolcode' => $request->schoolcode,
                'badge_path' => null,
            ]);

            if ($request->hasFile('badge_path')) {
                $folderPath = "schools/id_{$school->id}/assets";
                $badgePath = $request->file('badge_path')->store($folderPath, 'public');

                $school->update([
                    'badge_path' => $badgePath
                ]);
            }
    
      $user = Auth::user();
        $user->school_id = $school->id; 
        $user->save();

    return redirect('/dashboard')->with('success','Registration complete!');
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
