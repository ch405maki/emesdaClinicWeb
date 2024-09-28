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
        $appointments = Appointment::all();
        return inertia('Appointments/Index', ['appointments' => $appointments]);
    }

    public function manage()
    {
        $appointments = Appointment::where('status', 'pending')->get();
        return inertia('Appointments/Manage', ['appointments' => $appointments]);
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

    public function view($id)
    {
        // Fetch the appointment by ID and include related diagnostic and user data
        $appointment = Appointment::with(['patient', 'dentist', 'diagnostic'])
            ->findOrFail($id);

        // Render the view with the appointment data
        return Inertia::render('Appointments/View', [
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
        // Validate the request data
        $validated = $request->validate([
            'patient_id' => 'required|integer',
            'dentist_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,canceled',
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

    // Update appointment status
    $appointment->update(['status' => $validated['status']]);

    // Redirect to the manage page with a flash success message using Inertia
    return redirect()->back()->with('success', 'Appointment status updated successfully.');

}
    


    public function destroy(Appointment $appointment)
    {
        // Implement logic to delete an appointment
    }
}


