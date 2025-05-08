<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    // public function test_it_can_create_an_appointment()
    // {
    //     $patient = Patient::factory()->create();

    //     $appointment = Appointment::create([
    //         'patient_id' => $patient->id,
    //         'appointment_date' => now(),
    //         'status' => 'pending',
    //         'notes' => 'Test notes',
    //     ]);

    //     $this->assertDatabaseHas('appointment', [
    //         'patient_id' => $patient->id,
    //         'status' => 'pending',
    //     ]);
    // }
}
