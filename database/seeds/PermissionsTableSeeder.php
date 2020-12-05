<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['id' => '1', 'name' => 'view_role',   'display_name' => 'View Role',   'group' => 'Role', 'user_type' => 'Admin'],
            ['id' => '2', 'name' => 'add_role',    'display_name' => 'Add Role',    'group' => 'Role', 'user_type' => 'Admin'],
            ['id' => '3', 'name' => 'edit_role',   'display_name' => 'Edit Role',   'group' => 'Role', 'user_type' => 'Admin'],
            ['id' => '4', 'name' => 'delete_role', 'display_name' => 'Delete Role', 'group' => 'Role', 'user_type' => 'Admin'],

            ['id' => '5', 'name' => 'view_user',   'display_name' => 'View User',   'group' => 'User', 'user_type' => 'Admin'],
            ['id' => '6', 'name' => 'add_user',    'display_name' => 'Add User',    'group' => 'User', 'user_type' => 'Admin'],
            ['id' => '7', 'name' => 'edit_user',   'display_name' => 'Edit User',   'group' => 'User', 'user_type' => 'Admin'],
            ['id' => '8', 'name' => 'delete_user', 'display_name' => 'Delete User', 'group' => 'User', 'user_type' => 'Admin'],

            ['id' => '9',  'name' => 'view_test',  'display_name' => 'View Test',   'group' => 'Test', 'user_type' => 'Admin'],
            ['id' => '10', 'name' => 'add_test',   'display_name' => NULL,          'group' => 'Test', 'user_type' => 'Admin'],
            ['id' => '11', 'name' => 'edit_test',  'display_name' => 'Edit Test',   'group' => 'Test', 'user_type' => 'Admin'],
            ['id' => '12', 'name' => 'delete_test','display_name' => NULL,          'group' => 'Test', 'user_type' => 'Admin'],
        ];

        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        foreach($permissions as $permission) {
            Permission::create([
                'id'           => $permission['id'],
                'name'         => $permission['name'],
                'display_name' => $permission['display_name'],
                'group'        => $permission['group'],
                'user_type'    => $permission['user_type']
            ]);
        }
    }
}
