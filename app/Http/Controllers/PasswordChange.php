<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordChange extends Controller
{
public function showChangeForm()
    {
        return view('password');
    }
public function update(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = auth()->user();
    $user->password = Hash::make($request->password);
    $user->must_change_password = false; // clear flag
    $user->save();

    return redirect('/dashboard')->with('success', 'Password updated successfully.');
}
}
