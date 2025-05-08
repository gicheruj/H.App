<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class PatientController extends Controller
{
    /**
     * Display the patient registration form.
     */
    public function create(): Response
    {
        return Inertia::render('Profile/Partials/AddPatientForm');
    }

    /**
     * Handle an incoming patient creation request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'nullable|email|max:255|unique:patients,email',
            'phone'         => 'nullable|string|max:20',
            'age'           => 'required|integer|min:0|max:150',
            'gender'        => 'required|in:male,female',
            'date_of_birth' => 'nullable|date|before:today',
            'address'       => 'nullable|string|max:500',
        ]);

        $patient = Patient::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'age'           => $request->age,
            'gender'        => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address'       => $request->address,
        ]);

        return redirect()->route('nurse.dashboard')->with('success', 'Patient created successfully.');
    }
}

