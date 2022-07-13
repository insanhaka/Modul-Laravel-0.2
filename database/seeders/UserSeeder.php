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
            'status' => 99,
            'role_id' => 1,
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
            'name' => 'Supermin',
        ]);
        $role_admin = Role::create([
            'name' => 'Admin',
        ]);
        $role_user = Role::create([
            'name' => 'User',
        ]);

    }
}
