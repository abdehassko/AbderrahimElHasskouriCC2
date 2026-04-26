<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'General Consultation',
                'Blood Test',
                'MRI Scan',
                'X-Ray',
                'Surgery',
                'Physiotherapy Session',
            ]),
            'price' => fake()->randomFloat(2, 450, 20000),
            'description' => fake()->paragraph(),
            'category' => fake()->randomElement([
                'consultation',
                'diagnostics',
                'laboratory',
                'imaging',
                'surgery',
                'therapy',
                'emergency',
                'pharmacy',
                'home_care',
                'other',
            ]),
        ];
    }
}
