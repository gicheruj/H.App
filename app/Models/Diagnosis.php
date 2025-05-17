<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $table = 'diagnoses';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_id',
        'patient_name',
        'diagnosis',
        'prescribed_medication',
        'notes',
    ];

    // Relationships
    // public function patient()
    // {
    //     return $this->belongsTo(Patient::class);
    // }

    // public function doctor()
    // {
    //     return $this->belongsTo(User::class, 'doctor_id');
    // }

    // public function appointment()
    // {
    //     return $this->belongsTo(Appointment::class);
    // }
}
