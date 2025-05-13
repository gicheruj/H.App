<?php

namespace Database\Factories;

use App\Models\Prescription;
use App\Models\Diagnosis;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    protected $model = Prescription::class;

    public function definition(): array
    {
        return [
            'diagnosis_id'    => Diagnosis::factory(), // creates a related Diagnosis
            'doctor_id'       => User::factory(),      // creates a related User
            'medication_name' => $this->faker->word(),
            'dosage'          => $this->faker->randomElement(['10mg', '1 pill', '2 spoons']),
            'duration'        => $this->faker->numberBetween(3, 14) . ' days',
            'instructions'    => $this->faker->sentence(),
        ];
    }
}

