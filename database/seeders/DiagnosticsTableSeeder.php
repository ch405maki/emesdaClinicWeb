<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Appointment;
use App\Models\Diagnostic;

class DiagnosticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ensure the AppointmentsTableSeeder is run before this one, or the appointments must exist

        // Create diagnostics for the first appointment
        Diagnostic::create([
            'appointment_id' => 1, // ID for the first appointment
            'description' => 'Initial check-up and cleaning.',
            'service_rendered' => 'Teeth cleaning',
            'remarks' => 'No issues found',
            'dental_chart' => json_encode([
                'Upper Operation' => [
                    1 => 'GI',
                    2 => 'C',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'RF',
                    // Add more teeth as needed
                ],
                'Upper Condition' => [
                    1 => 'GI',
                    2 => 'C',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'RF',
                    // Add more teeth as needed
                ],
                'Middle Operation' => [
                    1 => 'P',
                    2 => 'Am',
                    3 => 'PJC',
                    4 => 'CF',
                    5 => 'AB',
                    // Add more teeth as needed
                ],
                'Middle Condition' => [
                    1 => 'P',
                    2 => 'Am',
                    3 => 'PJC',
                    4 => 'CF',
                    5 => 'AB',
                    // Add more teeth as needed
                ],
                'Middle Bottom Operation' => [
                    1 => 'GI',
                    2 => 'C',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'RF',
                    // Add more teeth as needed
                ],
                'Middle Bottom Condition' => [
                    1 => 'GI',
                    2 => 'C',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'RF',
                    // Add more teeth as needed
                ],
                'Lower Operation' => [
                    1 => 'GI',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'Am',
                    5 => 'AB',
                    // Add more teeth as needed
                ],
                'Lower Condition' => [
                    1 => 'GI',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'Am',
                    5 => 'AB',
                    // Add more teeth as needed
                ],
            ]),
        ]);

        // Create diagnostics for the second appointment
        Diagnostic::create([
            'appointment_id' => 2, // ID for the second appointment
            'description' => 'Cavity filling and dental X-ray.',
            'service_rendered' => 'Cavity filling and X-ray',
            'remarks' => 'Small cavity filled, advised regular check-ups',
            'dental_chart' => json_encode([
                'Upper Operation' => [
                    1 => 'C',
                    2 => 'CF',
                    3 => 'AB',
                    4 => 'PJC',
                    5 => 'M',
                    // Add more teeth as needed
                ],
                'Upper Condition' => [
                    1 => 'C',
                    2 => 'CF',
                    3 => 'AB',
                    4 => 'PJC',
                    5 => 'M',
                    // Add more teeth as needed
                ],
                'Middle Operation' => [
                    1 => 'Am',
                    2 => 'RF',
                    3 => 'GI',
                    4 => 'Un.',
                    5 => 'P',
                    // Add more teeth as needed
                ],
                'Middle Condition' => [
                    1 => 'Am',
                    2 => 'RF',
                    3 => 'GI',
                    4 => 'Un.',
                    5 => 'P',
                    // Add more teeth as needed
                ],
                'Middle Bottom Operation' => [
                    1 => 'C',
                    2 => 'GI',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'CF',
                    // Add more teeth as needed
                ],
                'Middle Bottom Condition' => [
                    1 => 'C',
                    2 => 'GI',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'CF',
                    // Add more teeth as needed
                ],
                'Lower Operation' => [
                    1 => 'RF',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'AB',
                    5 => 'GI',
                    // Add more teeth as needed
                ],
                'Lower Condition' => [
                    1 => 'RF',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'AB',
                    5 => 'GI',
                    // Add more teeth as needed
                ],
            ]),
        ]);
    }

}

