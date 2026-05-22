<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schools;
use RecursiveArrayIterator;

class LoginAndOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function store(Request $request)
{
    $validate = $request->validate([
        'email' => ['required', 'string', 'min:5'],
        'password' => ['required', 'min:6'],
        'schoolcode' => ['required', 'string', 'max:75'],
    ]);

    $school = Schools::where('schoolcode', $validate['schoolcode'])->first();

    if (!$school) {
        return back()->withErrors([
            'email' => 'The provided school code is incorrect.',
        ]);
    }

    if (Auth::attempt(['email' => $validate['email'], 'password' => $validate['password']])) {
        if (Auth::user()->school_id !== $school->id) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not belong to this school.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/register');
    }
}
