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

    if ($user->role == 'dentist' || $user->role == 'staff') {
        // Fetch unique patients who have appointments with diagnostics
        $appointments = Appointment::has('diagnostic')
            ->with(['patient', 'dentist', 'diagnostic'])
            ->get()
            ->unique('patient_id'); // Ensure unique patient records

        return Inertia::render('Reports/Index', [
            'appointments' => $appointments,
            'role' => $user->role,
        ]);
    } 
    
    elseif ($user->role === 'patient') {
        // Fetch all appointments related to the authenticated patient
        $appointments = Appointment::with(['patient', 'dentist', 'diagnostic'])
            ->where('patient_id', $user->id)
            ->get();

        // Fetch the latest diagnostic for the patient (if any)
        $latestDiagnostic = Diagnostic::whereIn('appointment_id', $appointments->pluck('id'))
            ->latest()
            ->first();

        return Inertia::render('Reports/History', [
            'appointments' => $appointments,
            'diagnostic' => $latestDiagnostic,
            'userRole' => $user->role
        ]);
    }

    // Default return (optional: prevent unintended behavior)
    return Inertia::render('Reports/Index', [
        'appointments' => [],
        'role' => $user->role,
    ]);
}


    public function history($patientId)
    {
        // Fetch all appointments related to the given patient ID
        $appointments = Appointment::with(['patient', 'dentist', 'diagnostic'])
            ->where('patient_id', $patientId)
            ->get();

        if ($appointments->isEmpty()) {
            abort(404, 'No appointments found for this patient');
        }

        // Fetch the latest diagnostic for the patient (if any)
        $latestDiagnostic = Diagnostic::whereIn('appointment_id', $appointments->pluck('id'))
            ->latest()
            ->first();

        // Get the authenticated user's role
        $userRole = auth()->user()->role;

        // Return Inertia response with all appointments, latest diagnostic, and user role
        return Inertia::render('Reports/History', [
            'appointments' => $appointments,
            'diagnostic' => $latestDiagnostic,
            'userRole' => $userRole
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
