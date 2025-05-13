<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'first_name'    => $this->faker->firstName(),
            'last_name'     => $this->faker->lastName(),
            'email'         => $this->faker->unique()->safeEmail(),
            'phone'         => $this->faker->phoneNumber(),
            'age'           => $this->faker->numberBetween(1, 100),
            'gender'        => $this->faker->randomElement(['male', 'female', 'other']),
            'date_of_birth' => $this->faker->date('Y-m-d', '-1 years'),
            'address'       => $this->faker->address(),
        ];
    }
}

