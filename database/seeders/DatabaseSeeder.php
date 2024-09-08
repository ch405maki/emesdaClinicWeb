<?php

namespace Database\Seeders;
use App\Models\Diagnostic;
use App\Models\Appointment;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create sample appointments
        $this->call([
            UsersTableSeeder::class,
            AppointmentsTableSeeder::class,
            DiagnosticsTableSeeder::class,
        ]);
    }
}
