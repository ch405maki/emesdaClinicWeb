<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Initialize the appointments query
        $query = Appointment::where('appointment_date', '>=', now()->startOfDay());

        // Check the user's role and adjust the query accordingly
        if ($user->role == 'dentist') {
            // Fetch all appointments for dentists
            $appointments = $query->where('dentist_id', $user->id)
                                  ->with(['student', 'diagnostic'])
                                  ->orderBy('appointment_date', 'asc')
                                  ->get();
        } elseif ($user->role == 'student') {
            // Fetch only appointments made by the student
            $appointments = $query->where('student_id', $user->id)
                                  ->with(['dentist', 'diagnostic'])
                                  ->orderBy('appointment_date', 'asc')
                                  ->get();
        } else {
            // If the user role is neither dentist nor student, return an empty collection
            $appointments = collect();
        }

        // Return the view with the fetched data
        return Inertia::render('Dashboard', [
            'appointments' => $appointments,
            'role' => $user->role, // Pass the role to the front end
        ]);
    }
}
