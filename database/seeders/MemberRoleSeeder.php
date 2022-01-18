<?php

namespace Database\Seeders;

use App\Models\MemberRole;
use Illuminate\Database\Seeder;

class MemberRoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'student',
            'teacher',  
            'accountant',
            'administrator',
        ];

        foreach($roles as $role)
            MemberRole::create(['name' => $role]);
    }
}
