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
        $ownerRole = Role::create(['name' => 'owner']);
        $buyerRole = Role::create(['name' => 'buyer']);
        $adminRole = Role::create(['name' => 'admin']);

        $user = User::create([
            'name' => 'Doni Owner',
            'email' => 'doni@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($ownerRole);
    }
}
