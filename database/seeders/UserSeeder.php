<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SAdmin = User::create([
            'name' => 'Super Admin',
            'username' => 'SAdmin',
            'email' => 'sadmin@system.com',
            'password' => bcrypt('rahasia'),
            'remember_token' => Str::random(10),
            'is_active' => true,
            'is_super' => true,
        ]);

        $create = Permission::create([
            'name' => 'create',
        ]);
        $edit = Permission::create([
            'name' => 'edit',
        ]);
        $delete = Permission::create([
            'name' => 'delete',
        ]);

        $role_super = Role::create([
            'name' => 'Manager',
            'color' => '#2e86de',
        ]);
        $role_admin = Role::create([
            'name' => 'Staff',
            'color' => '#ff9f43',
        ]);
        $role_user = Role::create([
            'name' => 'User',
            'color' => '#10ac84',
        ]);

        $SAdmin->roles()->sync([1]);

    }
}
