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

    public function it_stores_a_prescription_with_valid_data()
    {
        $diagnosis = Diagnosis::create([
            'patient_id' => 1,
            'doctor_id' => 1,
            'diagnosis' => 'Flu',
        ]);

        $doctor = User::create([
            'name' => 'Dr. Smith',
            'email' => 'doctor@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('prescriptions.store'), [
            'diagnosis_id'    => $diagnosis->id,
            'doctor_id'       => $doctor->id,
            'medication_name' => 'Amoxicillin',
            'dosage'          => '500mg',
            'duration'        => '7 days',
            'instructions'    => 'Take after meals',
        ]);

        $response->assertRedirect(route('doctor.dashboard'));
        $this->assertDatabaseHas('prescriptions', [
            'diagnosis_id'    => $diagnosis->id,
            'medication_name' => 'Amoxicillin',
        ]);
    }

    public function it_displays_the_prescription_list()
    {
        $prescriptions = [
            Prescription::create([
                'diagnosis_id'    => 1,
                'doctor_id'       => 1,
                'medication_name' => 'Amoxicillin',
                'dosage'          => '500mg',
                'duration'        => '7 days',
                'instructions'    => 'Take after meals',
            ]),
            Prescription::create([
                'diagnosis_id'    => 1,
                'doctor_id'       => 1,
                'medication_name' => 'Ibuprofen',
                'dosage'          => '200mg',
                'duration'        => '5 days',
                'instructions'    => 'Take with food',
            ]),
            Prescription::create([
                'diagnosis_id'    => 1,
                'doctor_id'       => 1,
                'medication_name' => 'Paracetamol',
                'dosage'          => '500mg',
                'duration'        => '3 days',
                'instructions'    => 'Take as needed for pain',
            ]),
        ];

        $response = $this->get(route('prescriptions.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) =>
            $page->component('Profile/Partials/PrescriptionsList')
                ->has('prescriptions', 3)
        );
    }

    public function a_pharmacist_can_store_a_prescription()
    {
        // Create a pharmacist user
        $pharmacist = User::factory()->create([
            'name' => 'Pharmacist Joe',
            'email' => 'pharmacist@example.com',
            'password' => bcrypt('password'),
            'role' => 'pharmacist',
        ]);

        // Create a diagnosis entry
        $diagnosis = Diagnosis::create([
            'patient_id' => 1,
            'doctor_id' => 1,
            'diagnosis' => 'Cold',
        ]);

        // Acting as the pharmacist
        $response = $this->actingAs($pharmacist)->post(route('prescription.store'), [
            'diagnosis_id'    => $diagnosis->id,
            'doctor_id'       => 1,
            'medication_name' => 'Loratadine',
            'dosage'          => '10mg',
            'duration'        => '5 days',
            'instructions'    => 'Take once daily',
        ]);

        $response->assertRedirect(route('doctor.dashboard')); // Adjust redirect if different
        $this->assertDatabaseHas('prescriptions', [
            'diagnosis_id'    => $diagnosis->id,
            'medication_name' => 'Loratadine',
        ]);
    }
}

