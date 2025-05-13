<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DiagnosisController extends Controller
{
    /**
     * Display the diagnosis creation form.
     */
    public function create(): Response
    {
        return Inertia::render('Profile/Partials/AddDiagnosisForm');
    }

    /**
     * Handle an incoming diagnosis creation request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'patient_id'      => 'required|exists:patients,id',
            'doctor_id'       => 'required|exists:users,id',
            'appointment_id'  => 'required|exists:appointments,id',
            'Patient_Name'    => 'required|string|max:255',
            'diagnosis'       => 'required|string',
            'notes'           => 'nullable|string',
        ]);

        Diagnosis::create([
            'patient_id'     => $request->patient_id,
            'doctor_id'      => $request->doctor_id,
            'appointment_id' => $request->appointment_id,
            'Patient_Name'   => $request->Patient_Name,
            'diagnosis'      => $request->diagnosis,
            'notes'          => $request->notes,
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Diagnosis created successfully.');
    }

}
