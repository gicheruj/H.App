<?php

namespace Tests\Unit;

use App\Models\Diagnosis;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrescriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $prescription = new Prescription();

        $this->assertEquals([
            'diagnosis_id',
            'doctor_id',
            'medication_name',
            'dosage',
            'duration',
            'instructions',
        ], $prescription->getFillable());
    }

    // If you add relationships later, you can also test them here.
}
