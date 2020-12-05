<?php

use App\Model\Preference;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $preferences = [
            [
                'id'          => 1,
                'category' => 'company-details',
                'field'       => 'name',
                'value'       => 'azStoreFinderz'
            ],
            [
                'id'          => 2,
                'category' => 'company-details',
                'field'       => 'email',
                'value'       => 'admin@azstorefinderz.com'
            ],
            [
                'id'          => 3,
                'category' => 'company-details',
                'field'       => 'phone',
                'value'       => '0123456789'
            ],
            [
                'id'          => 4,
                'category' => 'company-details',
                'field'       => 'address_1',
                'value'       => 'House CA/21'
            ],
            [
                'id'          => 5,
                'category' => 'company-details',
                'field'       => 'address_2',
                'value'       => 'Califorina'
            ],
            [
                'id'          => 6,
                'category' => 'company-details',
                'field'       => 'content',
                'value'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Preference::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($preferences as $preference) {
            Preference::create($preference);
        }
    }
}