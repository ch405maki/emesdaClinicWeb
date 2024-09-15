<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Appointment::create([
            'patient_id' => 1, // User ID for Mark Manuel
            'dentist_id' => 2, // User ID for Dr. Smith
            'appointment_date' => now()->addDays(1),
            'status' => 'confirmed',
        ]);

        Appointment::create([
            'patient_id' => 3, // User ID for Jane Student
            'dentist_id' => 2, // User ID for Dr. Smith
            'appointment_date' => now()->addDays(2),
            'status' => 'confirmed',
        ]);
    }
}
