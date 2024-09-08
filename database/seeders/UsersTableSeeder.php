<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a student
        User::create([
            'name' => 'Mark Manuel',
            'email' => 'mark@mail.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'age' => 20,
            'sex' => 'Male',
            'civil_status' => 'Single',
            'course_year' => 'BS Computer Science - 2nd Year',
            'contact' => '123-456-7890',
            'position' => 'Student',
            'address' => '123 Main St, Cityville',
            'ioe_name' => 'John Manuel',
            'ioe_relation' => 'Father',
            'ioe_address' => '123 Main St, Cityville',
            'ioe_contact' => '987-654-3210'
        ]);

        // Create a dentist
        User::create([
            'name' => 'Dr. Smith',
            'email' => 'drsmith@mail.com',
            'password' => Hash::make('password'),
            'role' => 'dentist',
            'age' => 45,
            'sex' => 'Female',
            'civil_status' => 'Married',
            'contact' => '123-555-7890',
            'position' => 'Dentist',
            'address' => '456 Elm St, Townsville',
            'ioe_name' => 'Michael Smith',
            'ioe_relation' => 'Spouse',
            'ioe_address' => '456 Elm St, Townsville',
            'ioe_contact' => '555-555-5555'
        ]);

        // Create another student
        User::create([
            'name' => 'Jane Student',
            'email' => 'jane@mail.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'age' => 22,
            'sex' => 'Female',
            'civil_status' => 'Single',
            'course_year' => 'BS Nursing - 3rd Year',
            'contact' => '321-654-9870',
            'position' => 'Student',
            'address' => '789 Oak St, Villagetown',
            'ioe_name' => 'Mary Student',
            'ioe_relation' => 'Mother',
            'ioe_address' => '789 Oak St, Villagetown',
            'ioe_contact' => '654-321-0987'
        ]);
    }
}
