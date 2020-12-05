<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'           => 1,
                'name'         => 'Admin',
                'display_name' => 'Admin',
                'description'  => 'Admin'
            ],
            [
                'id'           => 2,
                'name'         => 'User',
                'display_name' => 'User',
                'description'  => 'User'
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();
        
        foreach($roles as $role) {
            Role::create([
                'id'           => $role['id'], 
                'name'         => $role['name'],
                'display_name' => $role['display_name'],
                'description'  => $role['description'],
            ]);
        }
    }
}
