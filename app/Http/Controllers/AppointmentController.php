<?php

// app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all(); // Fetch appointments from the database
        return inertia('Appointments/Index', ['appointments' => $appointments]);
    }

    public function show($id)
    {
        // Fetch the appointment by ID and include related diagnostic and user data
        $appointment = Appointment::with(['patient', 'dentist', 'diagnostic'])
            ->findOrFail($id);

        // Render the view with the appointment data
        return Inertia::render('Appointments/Show', [
            'appointment' => $appointment
        ]);
    }

    public function create()
    {
        // Get the ID of the currently logged-in user
        $userId = Auth::id();

        // Pass the user ID to the view
        return Inertia::render('Appointments/Create', ['userId' => $userId]);
    }

    public function store(Request $request)
    {
        // Convert boolean-like strings to actual boolean values
        $request->merge([
            'good_health' => filter_var($request->input('good_health'), FILTER_VALIDATE_BOOLEAN),
            'medical_treatment' => filter_var($request->input('medical_treatment'), FILTER_VALIDATE_BOOLEAN),
            'surgical_operation' => filter_var($request->input('surgical_operation'), FILTER_VALIDATE_BOOLEAN),
            'hospitalized' => filter_var($request->input('hospitalized'), FILTER_VALIDATE_BOOLEAN),
            'tobacco' => filter_var($request->input('tobacco'), FILTER_VALIDATE_BOOLEAN),
            'alcohol' => filter_var($request->input('alcohol'), FILTER_VALIDATE_BOOLEAN),
            'pregnant' => filter_var($request->input('pregnant'), FILTER_VALIDATE_BOOLEAN),
        ]);

        // Validate the request data
        $validated = $request->validate([
            'patient_id' => 'required|integer',
            'dentist_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,canceled',
            'last_dentist' => 'nullable|string|max:255',
            'occlusion' => 'nullable|string|max:255',
            'dent_anomaly' => 'nullable|string|max:255',
            'good_health' => 'required|boolean',
            'medical_treatment' => 'required|boolean',
            'surgical_operation' => 'required|boolean',
            'hospitalized' => 'required|boolean',
            'medication' => 'nullable|string|max:255',
            'tobacco' => 'required|boolean',
            'alcohol' => 'required|boolean',
            'allergy' => 'nullable|string|max:255',
            'pregnant' => 'nullable|boolean',
            'other' => 'nullable|string|max:255',
        ]);

        // Create a new appointment with all fields
        Appointment::create($validated);

        // Return a success response
        return redirect()->route('dashboard')->with('success', 'Appointment created successfully.');
    }



    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,completed,canceled',
        ]);

        $appointment->update(['status' => $validated['status']]);

        //return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        // Implement logic to delete an appointment
    }
}


