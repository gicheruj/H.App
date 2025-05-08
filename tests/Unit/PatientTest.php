<?php

namespace Tests\Unit;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_patient()
    {
        $patient = Patient::create([
            'first_name' => 'Alice',
            'last_name' => 'Smith',
            'email' => 'alice@example.com',
            'phone' => '123456789',
            'age' => 28,
            'gender' => 'female',
            'date_of_birth' => '1996-04-01',
            'address' => '123 Main St',
        ]);

        $this->assertDatabaseHas('patients', [
            'email' => 'alice@example.com',
            'first_name' => 'Alice',
        ]);
    }
}
