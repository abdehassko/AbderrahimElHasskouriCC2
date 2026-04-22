<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
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
                ->count(3)
                ->create([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctors->random()->id,
                    'service_id' => $services->random()->id,
                ]);
        }
    }
}