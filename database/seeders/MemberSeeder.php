<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name'      => 'Member',
            'email'     => 'member@email.test',
            'username'  => 'member',
            'password'  => Hash::make('password'),
        ]);

        $user->member()->create();
        $user->tokens()->create([
            'name'      => 'user',
            'abilities' => ['*'],
            'token'     => '77e3a233847b8dbde831c3aa78449d904e0d91f147a0112706fef5ca6685d55f' // 3|J5N8r9JElcno70K3hEik4FNVRgTWjhG4nFmsqxOO
        ]);
    }
}
