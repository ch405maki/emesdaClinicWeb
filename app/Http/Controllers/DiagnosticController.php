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
                
                // Additional data
                'occlusion' => 'nullable|string|max:255',
                'condition' => 'nullable|string|max:255',
                'hygiene' => 'nullable|string|max:255',
                'denture_upper' => 'nullable|string|max:255',
                'denture_lower' => 'nullable|string|max:255',
                'since_upper' => 'nullable|string|max:255',
                'since_lower' => 'nullable|string|max:255',
                'abnormalities' => 'nullable|string|max:255',
                'general_condition' => 'nullable|string|max:255',
                'physician' => 'nullable|string|max:255',
                'nature_treatment' => 'nullable|string|max:255',
                'alergies' => 'nullable|string|max:255',
                'history' => 'nullable|string|max:255',
                'ailments' => 'nullable|string|max:255',
                'bp' => 'nullable|string|max:255',
                'drugs' => 'nullable|string|max:255',
            ]);
            
            // Create a new Diagnostic entry
            Diagnostic::create([
                'appointment_id' => $validatedData['appointment_id'],
                'description' => $validatedData['description'],
                'service_rendered' => $validatedData['service_rendered'],
                'remarks' => $validatedData['remarks'],
                'dental_chart' => json_encode($validatedData['dental_chart']),
                
                // Add the new data to the creation process
                'occlusion' => $validatedData['occlusion'],
                'condition' => $validatedData['condition'],
                'hygiene' => $validatedData['hygiene'],
                'denture_upper' => $validatedData['denture_upper'],
                'denture_lower' => $validatedData['denture_lower'],
                'since_upper' => $validatedData['since_upper'],
                'since_lower' => $validatedData['since_lower'],
                'abnormalities' => $validatedData['abnormalities'],
                'general_condition' => $validatedData['general_condition'],
                'physician' => $validatedData['physician'],
                'nature_treatment' => $validatedData['nature_treatment'],
                'alergies' => $validatedData['alergies'],
                'history' => $validatedData['history'],
                'ailments' => $validatedData['ailments'],
                'bp' => $validatedData['bp'],
                'drugs' => $validatedData['drugs'],
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
