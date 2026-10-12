<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Database\Seeders\RolesSeeder;
class AppointmentConflictTest extends TestCase
{
    /**
     * A basic feature test example.
     */
use RefreshDatabase;

public function test_overlapping_appointment_is_rejected(): void
{
    $this->seed(RolesSeeder::class);

    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $this->actingAs($admin);

    $patient = Patient::create([
        'full_name' => 'Test Patient',
        'national_id_number' => 'TEST-001',
        'age' => 25,
        'gender' => 'male',
        'phone' => '05551234567',
        'address' => 'Test address',
    ]);

    $doctor = Doctor::create([
        'name' => 'Test Doctor',
        'speciality' => 'General',
        'phone' => '05551234567',
    ]);
    $start = now()->addDay()->startOfDay()->addHours(10);

Appointment::create([
    'patient_id' => $patient->id,
    'doctor_id' => $doctor->id,
    'starts_at' => $start,
]);

$this->from(route('appointments.create'))
    ->post(route('appointments.store'), [
        'patient_id' => $patient->id,
        'doctor_id' => $doctor->id,
        'starts_at' => $start->copy()->addMinutes(15)
            ->format('Y-m-d\TH:i'),
    ])
    ->assertRedirect(route('appointments.create'))
    ->assertSessionHasErrors('starts_at');

$this->assertDatabaseCount('appointments', 1);
}
public function test_back_to_back_appointment_is_allowed(): void
{
$this->seed(RolesSeeder::class);

    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $this->actingAs($admin);

    $patient = Patient::create([
        'full_name' => 'Test Patient',
        'national_id_number' => 'TEST-001',
        'age' => 25,
        'gender' => 'male',
        'phone' => '05551234567',
        'address' => 'Test address',
    ]);

    $doctor = Doctor::create([
        'name' => 'Test Doctor',
        'speciality' => 'General',
        'phone' => '05551234567',
    ]);
    $start = now()->addDay()->startOfDay()->addHours(10);

Appointment::create([
    'patient_id' => $patient->id,
    'doctor_id' => $doctor->id,
    'starts_at' => $start,
]);

$this->from(route('appointments.create'))
    ->post(route('appointments.store'), [
        'patient_id' => $patient->id,
        'doctor_id' => $doctor->id,
        'starts_at' => $start->copy()->addMinutes(30)
            ->format('Y-m-d\TH:i'),
    ])
    ->assertRedirect(route('appointments.create'))
    ->assertSessionHasNoErrors();

$this->assertDatabaseCount('appointments', 2);
}
}
