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
            'last_dentist' => 'Dr. Johnson',
            'occlusion' => 'Normal',
            'dent_anomaly' => 'None',
            'good_health' => true,
            'medical_treatment' => false,
            'surgical_operation' => false,
            'hospitalized' => false,
            'medication' => null,
            'tobacco' => false,
            'alcohol' => false,
            'allergy' => null,
            'pregnant' => null,
            'other' => 'N/A',
        ]);

        Appointment::create([
            'patient_id' => 3, // User ID for Jane Student
            'dentist_id' => 2, // User ID for Dr. Smith
            'appointment_date' => now()->addDays(2),
            'status' => 'confirmed',
            'last_dentist' => 'Dr. Allen',
            'occlusion' => 'Overbite',
            'dent_anomaly' => 'None',
            'good_health' => true,
            'medical_treatment' => true,
            'surgical_operation' => false,
            'hospitalized' => false,
            'medication' => 'Antibiotics',
            'tobacco' => false,
            'alcohol' => false,
            'allergy' => 'Peanuts',
            'pregnant' => null,
            'other' => 'N/A',
        ]);
    }
}
