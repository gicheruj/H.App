<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{

    protected $table = 'diagnoses';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_id',
        'Patient_Name',
        'diagnosis',
        'notes',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
