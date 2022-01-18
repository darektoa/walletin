<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SchoolSeeder::class,
            MemberRoleSeeder::class,
            MemberSeeder::class,
            MerchantSeeder::class,
        ]);

        
        // \App\Models\User::factory(10)->create();
    }
}
