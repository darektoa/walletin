<?php

namespace Database\Seeders;

use App\Models\{School, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MerchantSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name'      => 'Merchant',
            'email'     => 'merchant@email.test',
            'username'  => 'merchant',
            'password'  => Hash::make('password'),
        ]);

        $user->merchant()->create([
            'school_id' => School::first()->id,
        ]);

        $user->tokens()->create([
            'name'      => 'user',
            'abilities' => ['*'],
            'token'     => '12844264728736c1f50b6dc9aa7bd854305981cf8fbffa4b6c99da08020a5404' // 4|wVs7Kp5V2EgqEk1vQoUsI6AV1d12Y3Q1PZmpigcg
        ]);
    }
}
