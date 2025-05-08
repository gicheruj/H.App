<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AppointmentController extends Controller
{
    /**
     * Display the appointment creation form.
     */
    public function create(): Response
    {
        return Inertia::render('Profile/Partials/AddAppointmentForm', [
            'patients' => Patient::all(),
            'doctors' => User::where('role', 'doctor')->get(),
        ]);
    }

    /**
     * Handle an incoming appointment creation request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'doctor_id'         => ['required', Rule::exists('users', 'id')->where('role', 'doctor')],
            'appointment_date'  => 'required|date|after:now',
            'status'            => ['required', Rule::in(['pending', 'completed', 'cancelled'])],
            'notes'             => 'nullable|string',
        ]);

        Appointment::create([
            'patient_id'       => $request->patient_id,
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'status'           => $request->status,
            'notes'            => $request->notes,
        ]);

        return redirect()->route('nurse.dashboard')->with('success', 'Patient created successfully.');
    }
}
