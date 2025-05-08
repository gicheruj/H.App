<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_nurse_can_view_patient_form()
    {
        $nurse = User::factory()->create(['role' => 'nurse']);

        $response = $this->actingAs($nurse)->get('/dashboard/nurse/patients/create');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Profile/Partials/AddPatientForm'));
    }

    public function test_nurse_can_create_patient()
    {
        $nurse = User::factory()->create(['role' => 'nurse']);

        $response = $this->actingAs($nurse)->post('/dashboard/nurse/patients', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'age' => 30,
            'gender' => 'male',
            'date_of_birth' => '1993-01-01',
            'address' => '123 Main Street',
        ]);

        $response->assertRedirect(route('nurse.dashboard'));
        $this->assertDatabaseHas('patients', [
            'first_name' => 'John',
            'email' => 'john@example.com',
        ]);
    }
}
