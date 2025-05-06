<?php

use App\Http\Controllers\ProfileController;
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



require __DIR__.'/auth.php';
