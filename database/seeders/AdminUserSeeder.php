<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'wanzaj4@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Customers::create([
            'name' => 'Walk In Customer',
            'email' => 'fratijwalkin@gmail.com',
            'taxID' => '00000000',
            'phone_number' => '0713684158',
            'status' => '1',
        ]);
    }
}