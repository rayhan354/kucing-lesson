<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $studentRole = Role::create([
            'name' => 'student'
        ]);

        $mentorRole = Role::create([
            'name' => 'mentor'
        ]);

        $user = User::create([
            'name' => 'asd',
            'email' => 'asd@asd.sd',
            'password' => bcrypt('asd')
        ]);

        $user2 = User::create([
            'name' => 'sdf',
            'email' => 'sdf@sdf.df',
            'password' => bcrypt('sdf')
        ]);

        $user->assignRole($adminRole);
        $user2->assignRole($studentRole);
    }
}
