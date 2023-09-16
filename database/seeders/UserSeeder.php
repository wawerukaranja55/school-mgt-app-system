<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $adminrole=Role::where(['role_name'=>'Admin'])->first();
        // $admingrade=Grade::where(['grade_name'=>'null'])->first();

        User::create([
            'name'=>'admin',
            'is_approved'=>'1',
            'role_id'=>'1',
            'grade_id'=>'13',
            'email'=>'admin@example.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('admin'),
            'remember_token'=>Str::random(10)
        ]);
    }
}
