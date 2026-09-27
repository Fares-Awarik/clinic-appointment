<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$deletePatients = Permission::findOrCreate('delete patients', 'web');
$deleteDoctors = Permission::findOrCreate('delete doctors', 'web');
$changeAppointmentStatus = Permission::findOrCreate('change appointment status', 'web');
$admin = Role::findOrCreate('admin', 'web');
Role::findOrCreate('doctor', 'web');
$receptionist = Role::findOrCreate('receptionist', 'web');

$admin->givePermissionTo($deletePatients);
$admin->givePermissionTo($deleteDoctors);
$admin->givePermissionTo($changeAppointmentStatus);
$receptionist->givePermissionTo($changeAppointmentStatus);
$createAppointments = Permission::findOrCreate('create appointments', 'web');
$admin->givePermissionTo($createAppointments);
$receptionist->givePermissionTo($createAppointments);
    }
}
