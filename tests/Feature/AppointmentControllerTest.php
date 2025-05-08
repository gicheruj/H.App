<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    // public function test_nurse_can_view_appointment_form(): void
    // {
    //     $this->markTestSkipped('Appointment form route/view not implemented yet.');
    // }

    // public function test_nurse_can_create_appointment(): void
    // {
    //     // Create a user with role 'nurse'
    //     $nurse = User::create([
    //         'name' => 'Test Nurse',
    //         'email' => 'nurse@example.com',
    //         'password' => bcrypt('password'),
    //         'role' => 'nurse',
    //     ]);

    //     // Create a patient
    //     $patient = Patient::create([
    //         'first_name' => 'Jane',
    //         'last_name' => 'Doe',
    //         'email' => 'jane@example.com',
    //         'phone' => '1234567890',
    //         'age' => 30,
    //         'gender' => 'female',
    //         'date_of_birth' => '1995-01-01',
    //         'address' => '123 Main St',
    //     ]);

    //     $response = $this->actingAs($nurse)->post('/appointments', [
    //         'patient_id' => $patient->id,
    //         'appointment_date' => now()->toDateTimeString(),
    //         'status' => 'pending',
    //         'notes' => 'Routine checkup',
    //     ]);

    //     $response->assertStatus(302); // Expect redirect after creation

    //     $this->assertDatabaseHas('appointments', [
    //         'patient_id' => $patient->id,
    //         'notes' => 'Routine checkup',
    //     ]);
    // }
}



