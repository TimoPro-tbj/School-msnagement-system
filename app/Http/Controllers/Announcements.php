<?php

namespace App\Http\Controllers;


use App\Models\Students;
use App\Models\User;
use App\Models\Schools;
use App\Models\Actions;
use App\Models\Courses;
use App\Models\Teachers;
use Illuminate\Http\Request;
use App\Models\Annoucement;
use Illuminate\Support\Facades\Auth;

class Announcements extends Controller
{
    public function index()
{
    $adminSchoolId = auth()->user()->school_id;

    // Get teachers with their linked user account
    $teachers = Teachers::where('school_id', $adminSchoolId)
        ->with('user') // eager load user
        ->get();

    $actions = Actions::where('admin_id', Auth::id())
        ->latest()
        ->paginate(10);

    return view('admin.announcemet', compact('teachers', 'actions'));
}



     public function create()
    {
        return view('admin.announcemet');
     }
       public function store(Request $request)  {
       $request->validate([
      'message' =>['required', 'string','max:75'],
     ] );

     Annoucement::create([
       'message'=>$request->message,
       'school_id' => Auth::user()->school_id,  
          ]);
     return redirect('/dashboard');
    }
}
