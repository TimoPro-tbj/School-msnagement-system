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

    public function store(Request $request)
    {
        $request->validate([
            'schoolname' => 'required|string|max:75',
            'schoolcode' => 'required|string|max:75',
            'name' => 'required|string|max:75',
            'email' => 'required|string|min:5|unique:users,email',
            'password' => 'required|string|min:6',
            'badge_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2049',
        ]);

        DB::beginTransaction();

        try {
            $schoolRecord = Schools::create([
                'schoolname' => $request->schoolname,
                'schoolcode' => $request->schoolcode,
                'badge_path' => null,
            ]);

            if ($request->hasFile('badge_path')) {
                $folderPath = "schools/id_{$schoolRecord->id}/assets";
                $badgePath = $request->file('badge_path')->store($folderPath, 'public');

                $schoolRecord->update([
                    'badge_path' => $badgePath
                ]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'school_id' => $schoolRecord->id,
            ]);

            DB::commit();
           Auth::login($user);
            return redirect('/dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
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
