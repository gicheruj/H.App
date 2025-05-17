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
        $response = $this->actingAs($doctor)->post('/dashboard/doctor/diagnosis', [
            'patient_id'     => $patient->id,
            'doctor_id'      => $doctor->id,
            'appointment_id' => $appointment->id,
            'patient_name'   => 'John Doe',
            'diagnosis'      => 'Flu',
            'prescribed_medication' => 'Antibiotic',
            'notes'          => 'Bed rest recommended.',
        ]);
        

        // Assert that the response redirects to the doctor's dashboard
        // $response->assertRedirect(route('doctor.dashboard'));

        // Assert that the diagnosis was correctly stored in the database
        $this->assertDatabaseHas('diagnoses', [
            'patient_id'     => $patient->id,
            'doctor_id'      => $doctor->id,
            'appointment_id' => $appointment->id,
            'patient_name'   => 'John Doe',
            'diagnosis'      => 'Flu',
            'prescribed_medication' => 'Antibiotic',
            'notes'          => 'Bed rest recommended.',
        ]);
    }

    public function test_pharmacist_can_view_diagnosis_list()
    {
        $doctor = User::create([
            'name'     => 'Dr. Adams',
            'email'    => 'adams@example.com',
            'password' => bcrypt('password'),
            'role'     => 'doctor',
        ]);

        $pharmacist = User::create([
            'name'     => 'Pharmacist Joy',
            'email'    => 'pharma@example.com',
            'password' => bcrypt('password'),
            'role'     => 'pharmacist',
        ]);

        $patient = Patient::create([
            'first_name'    => 'Alice',
            'last_name'     => 'Smith',
            'email'         => 'alice@example.com',
            'phone'         => '0987654321',
            'age'           => 28,
            'gender'        => 'female',
            'date_of_birth' => '1997-03-15',
            'address'       => '456 Health Ave',
        ]);

        $appointment = Appointment::create([
            'patient_id'       => $patient->id,
            'doctor_id'        => $doctor->id,
            'appointment_date' => '2025-05-16 10:00:00',
            'status'           => 'completed',
            'notes'            => 'Follow-up visit',
        ]);

        Diagnosis::create([
            'patient_id'            => $patient->id,
            'doctor_id'             => $doctor->id,
            'appointment_id'        => $appointment->id,
            'patient_name'          => 'Alice Smith',
            'diagnosis'             => 'Malaria',
            'prescribed_medication' => 'ACTs',
            'notes'                 => 'Take after meals',
        ]);

        $response = $this->actingAs($pharmacist)->get('/dashboard/pharmacist/diagnosis');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) =>
            $page->component('Profile/Partials/DiagnosisList')
                 ->has('diagnoses', 1)
                 ->where('diagnoses.0.diagnosis', 'Malaria')
        );
    }
}



