<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::findOrCreate('admin', 'web');
        Role::findOrCreate('doctor', 'web');
        Role::findOrCreate('receptionist', 'web');
    }
}
