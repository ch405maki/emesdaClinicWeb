<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diagnostic;

class DiagnosticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
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
                ],
                'Middle Operation' => [
                    1 => 'P',
                    2 => 'Am',
                    3 => 'PJC',
                    4 => 'CF',
                    5 => 'AB',
                ],
                'Middle Condition' => [
                    1 => 'P',
                    2 => 'Am',
                    3 => 'PJC',
                    4 => 'CF',
                    5 => 'AB',
                ],
                'Middle Bottom Operation' => [
                    1 => 'GI',
                    2 => 'C',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'RF',
                ],
                'Middle Bottom Condition' => [
                    1 => 'GI',
                    2 => 'C',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'RF',
                ],
                'Lower Operation' => [
                    1 => 'GI',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'Am',
                    5 => 'AB',
                ],
                'Lower Condition' => [
                    1 => 'GI',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'Am',
                    5 => 'AB',
                ],
            ]),
            // Additional fields
            'occlusion' => 'Normal',
            'condition' => 'Good',
            'hygiene' => 'Good',
            'denture_upper' => 'No',
            'denture_lower' => 'No',
            'since_upper' => null,
            'since_lower' => null,
            'abnormalities' => 'None',
            'general_condition' => 'Healthy',
            'physician' => 'Dr. Smith',
            'nature_treatment' => 'None',
            'alergies' => 'None',
            'history' => 'No significant medical history',
            'ailments' => 'None',
            'bp' => '120/80',
            'drugs' => 'None',
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
                ],
                'Upper Condition' => [
                    1 => 'C',
                    2 => 'CF',
                    3 => 'AB',
                    4 => 'PJC',
                    5 => 'M',
                ],
                'Middle Operation' => [
                    1 => 'Am',
                    2 => 'RF',
                    3 => 'GI',
                    4 => 'Un.',
                    5 => 'P',
                ],
                'Middle Condition' => [
                    1 => 'Am',
                    2 => 'RF',
                    3 => 'GI',
                    4 => 'Un.',
                    5 => 'P',
                ],
                'Middle Bottom Operation' => [
                    1 => 'C',
                    2 => 'GI',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'CF',
                ],
                'Middle Bottom Condition' => [
                    1 => 'C',
                    2 => 'GI',
                    3 => 'M',
                    4 => 'Un.',
                    5 => 'CF',
                ],
                'Lower Operation' => [
                    1 => 'RF',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'AB',
                    5 => 'GI',
                ],
                'Lower Condition' => [
                    1 => 'RF',
                    2 => 'PJC',
                    3 => 'CF',
                    4 => 'AB',
                    5 => 'GI',
                ],
            ]),
            // Additional fields
            'occlusion' => 'Slight misalignment',
            'condition' => 'Moderate',
            'hygiene' => 'Fair',
            'denture_upper' => 'No',
            'denture_lower' => 'No',
            'since_upper' => null,
            'since_lower' => null,
            'abnormalities' => 'Cavity',
            'general_condition' => 'Fair',
            'physician' => 'Dr. Adams',
            'nature_treatment' => 'Cavity filling',
            'alergies' => 'None',
            'history' => 'Occasional headaches',
            'ailments' => 'None',
            'bp' => '125/85',
            'drugs' => 'None',
        ]);
    }
}
