<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@cliniquemaroc.com',
            'password' => Hash::make('12121212'),
            'role' => 'admin',
        ]);

        User::create([
            'first_name' => 'Patient',
            'last_name' => 'Patient',
            'email' => 'patient@cliniquemaroc.com',
            'password' => Hash::make('12121212'),
            'role' => 'patient',
        ]);

        User::create([
            'first_name' => 'Abderrahim',
            'last_name' => 'El Hasskouri',
            'email' => 'rrahimabde033@gmail.com',
            'password' => Hash::make('abdeabde'),
            'role' => 'doctor',
        ]);

        $doctors = User::factory()
            ->count(10)
            ->state(['role' => 'doctor'])
            ->create();

        $patients = User::factory()
            ->count(25)
            ->state(['role' => 'patient'])
            ->create();

        $services = Service::factory()
            ->count(10)
            ->create();

        foreach ($patients as $patient) {
            Appointment::factory()
                ->create([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctors->random()->id,
                    'service_id' => $services->random()->id,
                ]);
        }
    }
}