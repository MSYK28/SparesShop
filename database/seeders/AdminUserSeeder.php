<?php

namespace Database\Seeders;

use App\Models\Customers;
use App\Models\Suppliers;
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

        Customers::create([
            'id' => 999,
            'name' => 'Null Customer',
            'email' => 'fratijnull@gmail.com',
            'taxID' => '00000000',
            'phone_number' => '0713684157',
            'status' => '2',
        ]);

        Suppliers::create(
            [
                'name' => 'Car & General',
                'email' => 'carandgeneral@gmail.com',
                'phone_number' => '0700112233',
                'taxID' => '12345678',
                'bank' => 'No Bank',
                'bank_name' => 'Car and General Trading Ltd',
                'bank_account' => '0000 1111 2222 3333',
                'status' => '1',
            ],
            [
                'name' => 'Gurjeet Kumar',
                'email' => 'carandgeneral@gmail.com',
                'phone_number' => '0700112234',
                'taxID' => '12345678',
                'bank' => 'No Bank',
                'bank_name' => 'Gurjeet Kumar Rajender',
                'bank_account' => '0000 1111 2222 4444',
                'status' => '1',
            ],
            [
                'name' => 'Nakuru Equipment Spares',
                'email' => 'carandgeneral@gmail.com',
                'phone_number' => '0700112235',
                'taxID' => '12345678',
                'bank' => 'No Bank',
                'bank_name' => 'Nakuru Equipment Spares',
                'bank_account' => '0000 1111 2222 5555',
                'status' => '1',
            ],
            [
                'name' => 'Tanga',
                'email' => 'carandgeneral@gmail.com',
                'phone_number' => '0700112236',
                'taxID' => '12345678',
                'bank' => 'No Bank',
                'bank_name' => 'Tanga',
                'bank_account' => '0000 1111 2222 6666',
                'status' => '1',
            ],
        );
    }
}