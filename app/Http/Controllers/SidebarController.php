<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class SidebarController extends Controller
{
    public function fetchPendingAppointments()
    {
        $appointments = Appointment::where('status', 'pending')
            ->where('appointment_date', '>=', Carbon::now()->startOfDay())
            ->get();

        return response()->json($appointments);
    }
}