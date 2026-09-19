<?php

namespace Tests\Feature;

use App\Models\Doctor;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_receptionist_cannot_delete_doctor(): void
    {
        $this->seed(RolesSeeder::class);

        $staff = User::factory()->create();
        $staff->assignRole('receptionist');

        $doctor = Doctor::create([
            'name' => 'Test Doctor',
            'speciality' => 'General',
            'phone' => '05551234567',
        ]);

        $this->actingAs($staff)
            ->delete(route('doctors.destroy', $doctor))
            ->assertForbidden();

        $this->assertDatabaseHas('doctors', [
            'id' => $doctor->id,
        ]);
    }

    public function test_admin_can_delete_doctor(): void
    {
        $this->seed(RolesSeeder::class);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $doctor = Doctor::create([
            'name' => 'Test Doctor',
            'speciality' => 'General',
            'phone' => '05551234567',
        ]);

        $this->actingAs($admin)
            ->delete(route('doctors.destroy', $doctor))
            ->assertRedirect(route('doctors.index'));

        $this->assertDatabaseMissing('doctors', [
            'id' => $doctor->id,
        ]);
    }
}