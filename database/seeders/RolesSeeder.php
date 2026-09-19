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

$admin = Role::findOrCreate('admin', 'web');
Role::findOrCreate('doctor', 'web');
Role::findOrCreate('receptionist', 'web');

$admin->givePermissionTo($deletePatients);
$admin->givePermissionTo($deleteDoctors);
    }
}
