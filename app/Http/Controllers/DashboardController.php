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
    $query = Appointment::where('appointment_date', '>=', now()->startOfDay())
                ->where('status', 'confirmed');

        // Initialize variables to avoid undefined variable issues
        $request = collect();
        $appointments = collect();
        $report = null;

        if ($user->role == 'dentist') {
            $request = Appointment::
                        where('status', 'pending')
                        ->where('appointment_date', '>=', now()->startOfDay())
                        ->get();
            $appointments = Appointment::
                            where('appointment_date', '>=', now()->startOfDay())
                            ->where('status', 'confirmed')->get();
            $report = Appointment::has('diagnostic')
                            ->with(['patient', 'dentist', 'diagnostic'])
                            ->where('status', 'confirmed')
                            ->latest('appointment_date')
                            ->limit(5)
                            ->get();
        }
        elseif ($user->role == 'staff') {
            $request = Appointment::
                        where('status', 'pending')
                        ->where('appointment_date', '>=', now()->startOfDay())
                        ->get();
            $appointments = Appointment::
                            where('appointment_date', '>=', now()->startOfDay())
                            ->where('status', 'confirmed')->get();
            $report = Appointment::has('diagnostic')
                            ->with(['patient', 'dentist', 'diagnostic'])
                            ->where('status', 'confirmed')
                            ->latest('appointment_date')
                            ->limit(5)
                            ->get();
        }
        elseif ($user->role == 'patient') {
            $request = Appointment::
                        where('patient_id', $user->id)
                        ->where('status', 'pending')
                        ->where('appointment_date', '>=', now()->startOfDay())
                        ->get();
            $appointments = Appointment::where('patient_id', $user->id)
                                ->where('status', 'confirmed')
                                ->where('appointment_date', '>=', now()->startOfDay())
                                ->with(['dentist', 'diagnostic'])
                                ->orderBy('appointment_date', 'asc')
                                ->get();
            $report = $report ?? null;
        }

        // Return the view with the fetched data
        return Inertia::render('Dashboard', [
            'appointments' => $appointments,
            'role' => $user->role,
            'request' => $request,
            'reports' => $report,
        ]);
    }

}
