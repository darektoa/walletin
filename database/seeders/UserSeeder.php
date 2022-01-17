<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name'      => 'User',
            'email'     => 'user@email.test',
            'username'  => 'user',
            'password'  => Hash::make('password'),
        ]);

        $user->tokens()->create([
            'name'      => 'user',
            'abilities' => ['*'],
            'token'     => '5d6dc161f8abeeaf7911a9670d799e73e3463bcbc9ec6797e1a47b8cca5b38d5' // 1|JU5hcHLyJAKxqrvdJUmIpsql5znPGLMaFoqj4QiG
        ]);
    }
}
