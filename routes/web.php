<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DoctorController;
    use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::resource('doctors', DoctorController::class)
    ->middlewareFor('destroy', 'can:delete doctors');
Route::resource('patients', PatientController::class)
    ->middlewareFor('destroy', 'can:delete patients');
});

require __DIR__.'/auth.php';
