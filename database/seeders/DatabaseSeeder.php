<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AdminUserSeeder as SeedersAdminUserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(SeedersAdminUserSeeder::class);
    }
    
}
