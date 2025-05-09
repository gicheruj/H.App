<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DiagnosisController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:nurse'])->get('/dashboard/nurse', function () {
    return Inertia::render('Profile/Partials/NurseDashboard');
})->name('nurse.dashboard');

Route::middleware(['auth', 'role:doctor'])->get('/dashboard/doctor', function () {
    return Inertia::render('Profile/Partials/DoctorDashboard');
})->name('doctor.dashboard');

Route::middleware(['auth', 'role:pharmacist'])->get('/dashboard/pharmacist', function () {
    return Inertia::render('Profile/Partials/PharmacistDashboard');
})->name('pharmacist.dashboard');


Route::middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/dashboard/nurse/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/dashboard/nurse/patients', [PatientController::class, 'store'])->name('patients.store');
});

Route::middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/dashboard/nurse/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/dashboard/nurse/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/dashboard/nurse/patients', [PatientController::class, 'index'])->name('patients.index');
});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/dashboard/doctor/patients/create', [DiagnosisController::class, 'create'])->name('diagnosis.create');
    Route::post('/dashboard/doctor/patients', [DiagnosisController::class, 'store'])->name('diagnosis.store');
    Route::get('/dashboard/doctor/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
});

require __DIR__.'/auth.php';
