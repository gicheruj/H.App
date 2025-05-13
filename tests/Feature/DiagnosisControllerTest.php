<?php

namespace Tests\Feature;

use App\Models\Diagnosis;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiagnosisControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a doctor can create a diagnosis.
     */
    public function test_doctor_can_create_diagnosis()
    {
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

        // Create a doctor
        $doctor = User::create([
            'name'     => 'Dr. Smith',
            'email'    => 'doctor@example.com',
            'password' => bcrypt('password'),
            'role' => 'doctor',
        ]);

        // Create an appointment for the doctor and patient
        $appointment = Appointment::create([
            'patient_id'       => $patient->id,
            'doctor_id'        => $doctor->id,
            'appointment_date' => '2025-05-15 14:00:00',
            'status'           => 'pending',
            'notes'            => 'Routine checkup',
        ]);

        // Authenticate as the doctor
        $response = $this->actingAs($doctor)->post('/dashboard/doctor/patients', [
            'patient_id'     => $patient->id,
            'doctor_id'      => $doctor->id,
            'appointment_id' => $appointment->id,
            'Patient_Name'   => 'John Doe',
            'diagnosis'      => 'Flu',
            'Prescribed_Medication' => 'Antibiotic',
            'notes'          => 'Bed rest recommended.',
        ]);
        

        // Assert that the response redirects to the doctor's dashboard
        // $response->assertRedirect(route('doctor.dashboard'));

        // Assert that the diagnosis was correctly stored in the database
        $this->assertDatabaseHas('diagnoses', [
            'patient_id'     => $patient->id,
            'doctor_id'      => $doctor->id,
            'appointment_id' => $appointment->id,
            'Patient_Name'   => 'John Doe',
            'diagnosis'      => 'Flu',
            'Prescribed_Medication' => 'Antibiotic',
            'notes'          => 'Bed rest recommended.',
        ]);
    }
}



