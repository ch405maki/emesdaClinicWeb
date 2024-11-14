<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class StaffController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Staff')->get();

        return Inertia::render('Staff/Index', ['users' => $users,]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',   
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        return redirect()->route('staff')->with('success', 'Staff created successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('staff');
    }
}
