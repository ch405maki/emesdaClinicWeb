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
        User::create([
            'name' => 'Mark Manuel',
            'email' => 'mark@mail.com',
            'password' => Hash::make('password'),
            'role' => 'patient',
            'age' => 20,
            'sex' => 'Male',
            'civil_status' => 'Single',
            'contact' => '123-456-7890',
            'address' => '123 Main St, Cityville',
            'occupation' => 'Student',
            'officeAddress' => 'N/A',
            'telNumber' => 'N/A'
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
            'address' => '456 Elm St, Townsville',
            'occupation' => 'Dentist',
            'officeAddress' => 'N/A',
            'telNumber' => '555-555-5555'
        ]);
        
        // Create another student
        User::create([
            'name' => 'Jane Student',
            'email' => 'jane@mail.com',
            'password' => Hash::make('password'),
            'role' => 'patient',
            'age' => 22,
            'sex' => 'Female',
            'civil_status' => 'Single',
            'contact' => '321-654-9870',
            'address' => '789 Oak St, Villagetown',
            'occupation' => 'Student',
            'officeAddress' => 'N/A',
            'telNumber' => 'N/A'
        ]);
    }
}
