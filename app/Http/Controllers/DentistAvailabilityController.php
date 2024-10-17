<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\DentistAvailability;
use Illuminate\Support\Facades\Auth;

class DentistAvailabilityController extends Controller
{
    /**
     * Show the availability form.
     */
    public function index()
    {
        // Fetch users with the role of "dentist"
        $dentists = User::where('role', 'dentist')->get();
        // Fetch all availability records
        $availability = DentistAvailability::with('dentist')->get(); // Optionally load associated dentists

        return Inertia::render('Availability/Index', [
            'dentists' => $dentists,
            'availability' => $availability,
        ]);
    }

    /**
     * Store dentist availability.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dentist_id' => 'required', // Ensure dentist_id is valid
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        DentistAvailability::create([
            'dentist_id' => $request->dentist_id, // Use the selected dentist ID
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Availability saved successfully.');
    }

    
    public function destroy($id)
    {
        $availability = DentistAvailability::findOrFail($id);
        $availability->delete();

        return redirect()->back()->with('success', 'Availability deleted successfully.');
    }

}
