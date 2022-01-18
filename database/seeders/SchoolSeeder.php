<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    public function run()
    {
        $school = User::create([
            'name'      => 'School',
            'email'     => 'school@email.test',
            'username'  => 'school',
            'password'  => Hash::make('password'),
        ]);

        $school->school()->create();
        $school->tokens()->create([
            'name'      => 'user',
            'abilities' => ['*'],
            'token'     => 'ee5c8da7f361881470ffe290d6362c60bf398364d449f40b652da74ea5bd4932' // 2|bX1c5dCsrHRkJNJRxWlbInkbYsiiZmQa7YoRdEWq
        ]);
    }
}
