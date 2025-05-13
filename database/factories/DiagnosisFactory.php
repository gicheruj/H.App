<?php

namespace Database\Factories;

use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiagnosisFactory extends Factory
{
    protected $model = Diagnosis::class;

    public function definition(): array
    {
        return [
            'patient_id'     => Patient::factory(),
            'doctor_id'      => User::factory(),
            'appointment_id' => Appointment::factory(),
            'Patient_Name'   => $this->faker->name(),
            'diagnosis'      => $this->faker->sentence(),
            'notes'          => $this->faker->optional()->paragraph(),
        ];
    }
}
