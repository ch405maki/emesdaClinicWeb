<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Diagnostic;
use Inertia\Inertia;
use PDF; 

class ReportController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        // Initialize the appointments query
        $query = Appointment::query();

        // Check the user's role and adjust the query accordingly
        if ($user->role == 'dentist') {
            // Fetch all appointments for dentists
            $appointments = Appointment::has('diagnostic')->with(['patient', 'dentist', 'diagnostic'])->get();

        } elseif ($user->role == 'patient') {
            // Fetch only appointments made by the patient
            $appointments = $query->where('patient_id', $user->id)
                                ->has('diagnostic')
                                ->with(['patient', 'dentist', 'diagnostic'])
                                ->get();
        }

        // Return the view with the fetched data
        return Inertia::render('Reports/Index', [
            'appointments' => $appointments,
            'role' => $user->role, // Pass the role to the front end
        ]);
    }

    public function show($id)
    {
        // Fetch the appointment by ID and include related patient, dentist, and diagnostic data
        $appointment = Appointment::with(['patient', 'dentist', 'diagnostic'])->findOrFail($id);

        // Fetch the latest diagnostic for the appointment
        $latestDiagnostic = Diagnostic::where('appointment_id', $id)
            ->latest('created_at')
            ->first();

        // Get the authenticated user's role
        $userRole = auth()->user()->role;

        // Return Inertia response with the appointment, latest diagnostic data, and user role
        return Inertia::render('Reports/Show', [
            'appointment' => $appointment,
            'diagnostic' => $latestDiagnostic,
            'userRole' => $userRole
        ]);
    }

}
