<?php

namespace Tests\Feature;

use App\Models\Prescription;
use App\Models\Diagnosis;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrescriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    // public function it_stores_a_prescription_with_valid_data()
    // {
    //     // Manually create related models
    //     $diagnosis = Diagnosis::create([
    //         'patient_id' => 1, // Add necessary attributes for Diagnosis
    //         'doctor_id' => 1,   // Add necessary attributes for Diagnosis
    //         'diagnosis' => 'Flu',
    //     ]);

    //     $doctor = User::create([
    //         'name' => 'Dr. Smith',
    //         'email' => 'doctor@example.com',
    //         'password' => bcrypt('password'),
    //     ]);

    //     // Create a prescription using valid data
    //     $response = $this->post(route('prescriptions.store'), [
    //         'diagnosis_id'    => $diagnosis->id,
    //         'doctor_id'       => $doctor->id,
    //         'medication_name' => 'Amoxicillin',
    //         'dosage'          => '500mg',
    //         'duration'        => '7 days',
    //         'instructions'    => 'Take after meals',
    //     ]);

    //     $response->assertRedirect(route('doctor.dashboard'));
    //     $this->assertDatabaseHas('prescriptions', [
    //         'diagnosis_id'    => $diagnosis->id,
    //         'medication_name' => 'Amoxicillin',
    //     ]);
    // }

    // /** @test */
    // public function it_displays_the_prescription_list()
    // {
    //     // Manually create prescriptions (use necessary attributes)
    //     $prescriptions = [
    //         Prescription::create([
    //             'diagnosis_id'    => 1,
    //             'doctor_id'       => 1,
    //             'medication_name' => 'Amoxicillin',
    //             'dosage'          => '500mg',
    //             'duration'        => '7 days',
    //             'instructions'    => 'Take after meals',
    //         ]),
    //         Prescription::create([
    //             'diagnosis_id'    => 1,
    //             'doctor_id'       => 1,
    //             'medication_name' => 'Ibuprofen',
    //             'dosage'          => '200mg',
    //             'duration'        => '5 days',
    //             'instructions'    => 'Take with food',
    //         ]),
    //         Prescription::create([
    //             'diagnosis_id'    => 1,
    //             'doctor_id'       => 1,
    //             'medication_name' => 'Paracetamol',
    //             'dosage'          => '500mg',
    //             'duration'        => '3 days',
    //             'instructions'    => 'Take as needed for pain',
    //         ]),
    //     ];

    //     $response = $this->get(route('prescriptions.index'));

    //     $response->assertStatus(200);
    //     $response->assertInertia(fn ($page) =>
    //         $page->component('Profile/Partials/PrescriptionsList')
    //             ->has('prescriptions', 3)
    //     );
    // }
}
