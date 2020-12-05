<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Faker();

        $users = [
            [
                'id'                => 1,
                'first_name'        => 'John',
                'last_name'         => 'Doe',
                'email'             => 'admin@gmail.com',
                'phone'             => '+8801718621513',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'user_type'         => 'Admin',
                'photo'             => NULL,
                'remember_token'    => Str::random(10),
                'status'            => 'active'
            ],
            [
                'id'                => 2,
                'first_name'        => 'Jane',
                'last_name'         => 'Doe',
                'email'             => 'user@gmail.com',
                'phone'             => NULL,
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'user_type'         => 'User',
                'photo'             => NULL,
                'remember_token'    => Str::random(10),
                'status'            => 'active'
            ],
            [
                'id'                => 3,
                'first_name'        => 'Suspended',
                'last_name'         => 'User',
                'email'             => 'suspended@gmail.com',
                'phone'             => NULL,
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'user_type'         => 'User',
                'photo'             => NULL,
                'remember_token'    => Str::random(10),
                'status'            => 'suspended'
            ],
            [
                'id'                => 4,
                'first_name'        => 'Inactive',
                'last_name'         => 'User',
                'email'             => 'inactive@gmail.com',
                'phone'             => NULL,
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'user_type'         => 'User',
                'photo'             => NULL,
                'remember_token'    => Str::random(10),
                'status'            => 'inactive'
            ]
        ];

        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($users as $user) {
            User::create($user);
        }
    }
}