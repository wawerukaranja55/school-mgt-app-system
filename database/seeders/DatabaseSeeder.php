<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\TermSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\Rolesseeder;
use Database\Seeders\SubjectsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Rolesseeder::class,
            GradeSeeder::class,
            UserSeeder::class,
            TermSeeder::class,
            SubjectsSeeder::class 
        ]);
    }
}
