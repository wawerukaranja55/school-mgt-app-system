<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create(['grade_name'=>'Grade 1','grade_level'=>'Primary']);
        Grade::create(['grade_name'=>'Grade 2','grade_level'=>'Primary']);
        Grade::create(['grade_name'=>'Grade 3','grade_level'=>'Primary']);
        Grade::create(['grade_name'=>'Grade 4','grade_level'=>'Primary']);
        Grade::create(['grade_name'=>'Grade 5','grade_level'=>'Primary']);
        Grade::create(['grade_name'=>'Grade 6','grade_level'=>'Primary']);
        Grade::create(['grade_name'=>'Grade 7','grade_level'=>'Junior Secondary']);
        Grade::create(['grade_name'=>'Grade 8','grade_level'=>'Junior Secondary']);
        Grade::create(['grade_name'=>'Grade 9','grade_level'=>'Junior Secondary']);
        Grade::create(['grade_name'=>'Grade 10','grade_level'=>'Senior Secondary']);
        Grade::create(['grade_name'=>'Grade 11','grade_level'=>'Senior Secondary']);
        Grade::create(['grade_name'=>'Grade 12','grade_level'=>'Senior Secondary']);
        Grade::create(['grade_name'=>'null','grade_level'=>'null']);
    }
}
