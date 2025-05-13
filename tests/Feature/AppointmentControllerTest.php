<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment; 
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_nurse_can_create_appointment(): void
    {
        // Create a nurse
        $nurse = User::create([
            'name' => 'Test Nurse',
            'email' => 'nurse@example.com',
            'password' => bcrypt('password'),
            'role' => 'nurse',
        ]);
    
        // Create a doctor
        $doctor = User::create([
            'name' => 'Test Doctor',
            'email' => 'doctor@example.com',
            'password' => bcrypt('password'),
            'role' => 'doctor',
        ]);
    
        // Create a patient
        $patient = Patient::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '1234567890',
            'age' => 30,
            'gender' => 'female',
            'date_of_birth' => '1995-01-01',
            'address' => '123 Main St',
        ]);
    
        // Send the POST request
        $response = $this->actingAs($nurse)->post('/dashboard/nurse/appointment', [
            'patient_id'       => $patient->id,
            'doctor_id'        => $doctor->id,
            'appointment_date' => now()->addDay()->toDateTimeString(),
            'status'           => 'pending',
            'notes'            => 'Routine checkup',
        ]);

    
        $response->assertStatus(302); // redirect
    
        $this->assertDatabaseHas('appointments', [
            'patient_id' => $patient->id,
            'doctor_id'  => $doctor->id,
            'notes'      => 'Routine checkup',
        ]);
    }

    public function test_doctor_can_view_appointments(): void
    {
        // Create a doctor
        $doctor = User::create([
            'name' => 'Test Doctor',
            'email' => 'doctor@example.com',
            'password' => bcrypt('password'),
            'role' => 'doctor',
        ]);
        
        // Create a patient
        $patient = Patient::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '1234567890',
            'age' => 30,
            'gender' => 'female',
            'date_of_birth' => '1995-01-01',
            'address' => '123 Main St',
        ]);
        
        // Create an appointment 
        $appointment = Appointment::create([
            'patient_id'       => $patient->id,
            'doctor_id'        => $doctor->id,
            'appointment_date' => '2025-05-15 14:00:00',
            'status'           => 'pending',
            'notes'            => 'Routine checkup',
        ]);

        $response = $this->actingAs($doctor)->get('/dashboard/doctor/appointments');

        $response->assertStatus(200);
        $response->assertSee($appointment->notes); 
    
}
}


