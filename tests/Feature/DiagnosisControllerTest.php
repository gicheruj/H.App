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

    /** @test */
    // public function it_stores_a_diagnosis_with_valid_data()
    // {
    //     // Manually create related models
    //     $patient = Patient::create([
    //         'name' => 'John Doe', // Add necessary attributes for Patient
    //         'dob' => '1990-01-01',
    //     ]);

    //     $doctor = User::create([
    //         'name' => 'Dr. Smith',
    //         'email' => 'doctor@example.com',
    //         'password' => bcrypt('password'),
    //     ]);

    //     $appointment = Appointment::create([
    //         'patient_id' => $patient->id,
    //         'doctor_id' => $doctor->id,
    //         'date' => now(),
    //     ]);

    //     // Create a diagnosis using valid data
    //     $response = $this->post(route('diagnoses.store'), [
    //         'patient_id'     => $patient->id,
    //         'doctor_id'      => $doctor->id,
    //         'appointment_id' => $appointment->id,
    //         'Patient_Name'   => 'John Doe',
    //         'diagnosis'      => 'Flu',
    //         'notes'          => 'Bed rest recommended.',
    //     ]);

    //     $response->assertRedirect(route('doctor.dashboard'));
    //     $this->assertDatabaseHas('diagnoses', [
    //         'patient_id'   => $patient->id,
    //         'doctor_id'    => $doctor->id,
    //         'Patient_Name' => 'John Doe',
    //     ]);
    // }

    // /** @test */
    // public function it_displays_the_diagnosis_list()
    // {
    //     // Manually create diagnoses
    //     Diagnosis::create([
    //         'patient_id' => 1,
    //         'doctor_id'  => 1,
    //         'diagnosis'  => 'Flu',
    //         'notes'      => 'Bed rest recommended.',
    //     ]);

    //     $response = $this->get(route('diagnoses.index'));

    //     $response->assertStatus(200);
    //     $response->assertInertia(fn ($page) =>
    //         $page->component('Profile/Partials/DiagnosesList')
    //             ->has('diagnoses', 1)
    //     );
    // }
}


