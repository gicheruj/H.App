<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_id',
        'doctor_id',
        'medication_name',
        'dosage',
        'duration',
        'instructions',
    ];
}

