<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create(['subject_name'=>'Mathematics']);
        Subject::create(['subject_name'=>'English']);
        Subject::create(['subject_name'=>'Kiswahili']);
        Subject::create(['subject_name'=>'Science']);
        Subject::create(['subject_name'=>'Social Studies']);
        Subject::create(['subject_name'=>'Home Science']);
        Subject::create(['subject_name'=>'CRE']);

    }
}
