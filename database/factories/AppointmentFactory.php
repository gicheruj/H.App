<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'patient_id'       => Patient::factory(),
            'doctor_id'        => User::factory(),
            'appointment_date' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'status'           => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'notes'            => $this->faker->optional()->sentence(),
        ];
    }
}
