<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherPromotedMail;
use App\Models\User;
use App\Models\Teachers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Schools;
use App\Models\Actions;

class AdminController extends Controller
{

public function promote(Request $request)
{
    $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'password'   => 'required|string|min:8',
    ]);

    $teacher = Teachers::findOrFail($request->teacher_id);

    
    if ($teacher->school_id !== auth()->user()->school_id) {
        return redirect('/admin/dashboard')
            ->withErrors(['error' => 'You cannot promote teachers from another school.']);
    }

    $user = User::where('email', $teacher->email)->first();

    if ($user) {
        $user->role = 'admin';
        $user->password = Hash::make($request->password);
        $user->must_change_password = true; // force reset on next login
        $user->save();
    }

    Actions::create([
        'admin_id' => auth()->id(),
        'action'   => "Promoted {$teacher->teacher_name} to Admin"
    ]);

    return redirect('/admin/dashboard')
        ->with('success', "{$teacher->teacher_name} is now an Admin with a new password. They must change it on first login.");
}

   public function actionsIndex(Request $request)
{
    $query = Actions::with('admin')->latest();

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $actions = $query->paginate(15);

    $count = Actions::count();

    return view('admin.actions', compact('actions', 'count'));
}

    public function deleteAction($id)
    {
        $action = Actions::where('admin_id', auth()->id())->findOrFail($id);
        $action->delete();

        return redirect('/admin/dashboard')
            ->with('success', 'Action removed successfully.');
    }

  public function exportActions()
{
    $actions = Actions::where('admin_id', auth()->id())->latest()->get();

    $csvData = "Time,Action\n";
    foreach ($actions as $action) {
        $csvData .= $action->created_at->format('d M Y H:i') . "," . $action->action . "\n";
    }

    return response($csvData)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename="admin_actions.csv"');
}

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('action_ids', []);
        if (!empty($ids)) {
            Actions::whereIn('id', $ids)->delete();
        }
        return redirect('/admin/dashboard')->with('success', 'Selected actions deleted successfully.');
    }

    
    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
