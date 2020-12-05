<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::orderBy('id', 'ASC')->get(['id']);
        $role = Role::get(['id', 'guard_name']);

        $user[0]->assignRole($role[0]);
        $user[1]->assignRole($role[1]);
        $user[2]->assignRole($role[1]);
        $user[3]->assignRole($role[1]);
    }
}
