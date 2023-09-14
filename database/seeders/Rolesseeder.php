<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Rolesseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['role_name'=>'Admin']);
        Role::create(['role_name'=>'Teacher']);
        Role::create(['role_name'=>'User']);
    }
}
