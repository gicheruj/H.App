<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

//     public function test_it_can_create_an_appointment()
//     {
//         // Manually create a patient
//         $patient = Patient::create([
//             'first_name' => 'John',
//             'last_name' => 'Doe',
//             'email' => 'johndoe@example.com',
//             'phone' => '123456789',
//             'age' => 35,
//             'gender' => 'male',
//             'date_of_birth' => '1989-01-01',
//             'address' => '456 Maple St',
//         ]);

//         // Create an appointment for the patient
//         $appointment = Appointment::create([
//             'patient_id' => $patient->id,
//             'doctor_id' => 1, // Replace with a valid doctor_id if necessary
//             'appointment_date' => now(),
//             'status' => 'pending',
//             'notes' => 'Test notes',
//         ]);

//         $this->assertDatabaseHas('appointments', [
//             'patient_id' => $patient->id,
//             'status' => 'pending',
//         ]);
//     }
}

