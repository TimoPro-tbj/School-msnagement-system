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
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
        'schoolcode' => 'required|string',
    ]);

    if (Auth::attempt([
        'email' => $credentials['email'],
        'password' => $credentials['password'],
    ])) {
        $request->session()->regenerate();

        // Check school code separately
$school = Schools::where('schoolcode', $credentials['schoolcode'])->first();
        if (!$school || Auth::user()->school_id !== $school->id) {
            Auth::logout();
            return back()->withErrors(['schoolcode' => 'Invalid school code.']);
        }

        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.'
    ]);
}

protected function authenticated(Request $request, $user)
{
    if ($user->must_change_password) {
        return redirect()->route('password.change');
    }

    return redirect()->intended('/dashboard');
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
