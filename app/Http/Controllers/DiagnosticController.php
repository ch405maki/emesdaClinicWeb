<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Diagnostic;
use App\Models\Appointment;
use Inertia\Inertia;


class DiagnosticController extends Controller
{
    /**
     * Show the Create to create a new diagnostic.
     */
    public function create(Request $request)
    {
        // Retrieve the appointment ID from the query parameters
        $appointmentId = $request->query('id');

        // Fetch the appointment details if needed (for display purposes)
        $appointment = Appointment::with('patient', 'dentist')->find($appointmentId);

        if (!$appointment) {
            return redirect()->route('appointments.index')->withErrors('Appointment not found');
        }

        // Render the Create with the appointment data
        return Inertia::render('Diagnostics/Create', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Store a new diagnostic.
     */
    public function store(Request $request)
{
    try {
        // Validate and process data
        $validatedData = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'description' => 'nullable|string|max:1000',
            'service_rendered' => 'nullable|string|max:1000',
            'remarks' => 'nullable|string|max:1000',
            'dental_chart' => 'nullable|array',
        ]);

        // Create a new Diagnostic entry
        Diagnostic::create([
            'appointment_id' => $validatedData['appointment_id'],
            'description' => $validatedData['description'],
            'service_rendered' => $validatedData['service_rendered'],
            'remarks' => $validatedData['remarks'],
            'dental_chart' => json_encode($validatedData['dental_chart']),
        ]);

        // Success response
        return redirect()->route('appointments.show', [$validatedData['appointment_id']])
                         ->with('success', 'Diagnostic created successfully.');
    } catch (\Exception $e) {
        // Log error and return response
        Log::error('Error saving diagnostic: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error saving diagnostic.');
    }
}


}
