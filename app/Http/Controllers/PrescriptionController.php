<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PrescriptionController extends Controller
{
    /**
     * Display the prescription creation form.
     */
    public function create(): Response
    {
        return Inertia::render('Profile/Partials/AddPrescriptionForm');
    }

    /**
     * Handle an incoming prescription creation request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'diagnosis_id'    => 'required|exists:diagnoses,id',
            'doctor_id'       => 'required|exists:users,id',
            'medication_name' => 'required|string|max:255',
            'dosage'          => 'required|string|max:255',
            'duration'        => 'required|string|max:255',
            'instructions'    => 'nullable|string',
        ]);

        Prescription::create([
            'diagnosis_id'    => $request->diagnosis_id,
            'doctor_id'       => $request->doctor_id,
            'medication_name' => $request->medication_name,
            'dosage'          => $request->dosage,
            'duration'        => $request->duration,
            'instructions'    => $request->instructions,
        ]);

        return redirect()->route('pharmacist.dashboard')->with('success', 'Prescription created successfully.');
    }

    public function index(): Response
    {
        $prescriptions = Prescription::all();

        return Inertia::render('Profile/Partials/PrescriptionsList', [
            'prescriptions' => $prescriptions
    ]);
    }
}
