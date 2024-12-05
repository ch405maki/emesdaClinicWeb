<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\DentistAvailability;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Mail\AppointmentConfirmation;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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

    public function staffAppointmentsManage()
    {
        $appointments = Appointment::with(['patient', 'dentist', 'diagnostic'])->where('status', 'pending')->get();
        return inertia('Appointments/StaffManage', ['appointments' => $appointments]);
    }

    public function myAppointments()
    {
        $userId = Auth::id();

        $appointments = Appointment::where('patient_id', $userId)->get();

        return inertia('Appointments/MyAppointments', ['appointments' => $appointments]);
    }

    public function show($id)
    {
        // Fetch the appointment by ID and include related diagnostic and user data
        $appointment = Appointment::with(['patient', 'dentist', 'diagnostic'])
            ->findOrFail($id);
        
        $user = Auth::user();

        // Render the view with the appointment data
        return Inertia::render('Appointments/Show', [
            'appointment' => $appointment,
            'role' => $user->role,
        ]);
    }

    public function view($id)
    {
        // Fetch the appointment by ID and include related diagnostic and user data
        $appointment = Appointment::with(['patient', 'dentist', 'diagnostic'])
            ->findOrFail($id);

        $user = Auth::user();

        // Render the view with the appointment data
        return Inertia::render('Appointments/View', [
            'appointment' => $appointment,
            'user' => $user,
        ]);
    }

    public function create()
    {
        // Get the ID of the currently logged-in user
        $userId = Auth::id();
        $DentistAvailability = DentistAvailability::with('dentist')
        ->where('date', '>=', now())
        ->get();

        return Inertia::render('Appointments/Create', ['userId' => $userId, 'availabilities' => $DentistAvailability]);
    }

    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validated = $request->validate([
    //         'patient_id' => 'required|integer',
    //         'dentist_id' => 'required|integer',
    //         'appointment_date' => 'required|date',
    //         'status' => 'required|in:pending,confirmed,completed,canceled',
    //     ]);

    //     dd($validated);

    //     // Create a new appointment with all fields
    //     Appointment::create($validated);

    //     // Return a success response
    //     return redirect()->route('appointments.my-appointments')->with('success', 'Appointment created successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'patient_id' => 'required|integer',
            'dentist_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,canceled',
        ]);

        // Optional: Check the validated data for debugging before further processing
        //dd($validated); // Uncomment if needed to inspect validated data

        // Parse the date and time from appointment_date
        $appointmentDate = \Carbon\Carbon::parse($validated['appointment_date']);
        $date = $appointmentDate->format('Y-m-d'); // Extract just the date
        $time = $appointmentDate->format('H:i:s'); // Extract just the time

        // Check dentist availability
        $availability = DentistAvailability::where('dentist_id', $validated['dentist_id'])
            ->where('date', $date)
            ->first();

        if (!$availability) {
            return back()->withErrors(['appointment_date' => 'The selected time is unavailable for the dentist.'])->withInput();
        }

        // Create a new appointment with the validated data
        
        $appointment = Appointment::create($validated);

        // dd($appointment);

        if ($appointment) {
            return redirect()->back()->with('success', 'Appointment status updated successfully.');
        } else {
            return back()->withErrors(['appointment_date' => 'Failed to save appointment, please try again.'])->withInput();
        }
    }


public function sendConfirmationEmail(Request $request)
{
    $data = $request->validate([
        'user_name' => 'required|string',
        'user_email' => 'required|email',
        'appointment_date' => 'required|date',
        'dentist_name' => 'required|string',
    ]);

    // Parse the appointment date and set it to Philippine Time
    $appointmentDate = Carbon::parse($data['appointment_date'])->setTimezone('Asia/Manila');

    // Format the date as "December 6, 2024 3:06 PM"
    $data['appointment_date'] = $appointmentDate->format('F j, Y h:i A');
    
    // Send the email
    Mail::to($data['user_email'])->send(new AppointmentConfirmation($data));

    return redirect()->back()->with('success', 'Appointment confirmation email sent successfully.');
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


