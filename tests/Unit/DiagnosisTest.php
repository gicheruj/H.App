<?php

namespace Tests\Unit;

use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiagnosisTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    // public function it_has_patient_relationship()
    // {
    //     $patient = Patient::factory()->create();
    //     $diagnosis = Diagnosis::factory()->create([
    //         'patient_id' => $patient->id,
    //     ]);

    //     $this->assertInstanceOf(Patient::class, $diagnosis->patient);
    //     $this->assertEquals($patient->id, $diagnosis->patient->id);
    // }

    // /** @test */
    // public function it_has_doctor_relationship()
    // {
    //     $doctor = User::factory()->create();
    //     $diagnosis = Diagnosis::factory()->create([
    //         'doctor_id' => $doctor->id,
    //     ]);

    //     $this->assertInstanceOf(User::class, $diagnosis->doctor);
    //     $this->assertEquals($doctor->id, $diagnosis->doctor->id);
    // }

    // /** @test */
    // public function it_has_appointment_relationship()
    // {
    //     $appointment = Appointment::factory()->create();
    //     $diagnosis = Diagnosis::factory()->create([
    //         'appointment_id' => $appointment->id,
    //     ]);

    //     $this->assertInstanceOf(Appointment::class, $diagnosis->appointment);
    //     $this->assertEquals($appointment->id, $diagnosis->appointment->id);
    // }

    /** @test */
    public function it_has_fillable_attributes()
    {
        $diagnosis = new Diagnosis();
        $this->assertEquals([
            'patient_id',
            'doctor_id',
            'appointment_id',
            'Patient_Name',
            'diagnosis',
            'notes',
        ], $diagnosis->getFillable());
    }
}
