<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string', // Add validation for the 'role' field
            'age' => 'required|numeric', // Add validation for the 'age' field
            'sex' => 'required|string', // Add validation for the 'sex' field
            'civil_status' => 'required|string', // Add validation for the 'civil_status' field
            'course_year' => 'required|string', // Add validation for the 'course_year' field
            'contact' => 'required|string', // Add validation for the 'contact' field
            'position' => 'string|nullable', // Add validation for the 'position' field
            'address' => 'required|string', // Add validation for the 'ioe_address' field
            'ioe_name' => 'required|string', // Add validation for the 'ioe_name' field
            'ioe_relation' => 'required|string', // Add validation for the 'ioe_relation' field
            'ioe_address' => 'required|string', // Add validation for the 'ioe_address' field
            'ioe_contact' => 'required|string', // Add validation for the 'ioe_contact' field
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'age' => $request->age,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'course_year' => $request->course_year,
            'contact' => $request->contact,
            'position' => $request->position,
            'address' => $request->address,
            'ioe_name' => $request->ioe_name,
            'ioe_relation' => $request->ioe_relation,
            'ioe_address' => $request->ioe_address,
            'ioe_contact' => $request->ioe_contact,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
}
