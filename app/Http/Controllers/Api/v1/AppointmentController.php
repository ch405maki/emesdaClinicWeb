<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function index()
    {
        try {
            $appointments = Appointment::all(); // Use plural for consistency
            return response()->json(['appointments' => $appointments]);
        } catch (\Exception $e) {
            Log::error('Error fetching appointments: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function create()
    {
        // Logic for creating an appointment form
        return response()->json(['message' => 'Form data for creating appointment']);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'patient_id' => 'required',
                'dentist_id' => 'required',
                'appointment_date' => 'required|date',
                'status' => 'required|string',
            ]);

            $appointment = Appointment::create($request->all());

            return response()->json($appointment, 201);
        } catch (\Exception $e) {
            Log::error('Error creating appointment: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
