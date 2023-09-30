<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Term::create(['term_name'=>'Term 1']);
        Term::create(['term_name'=>'Term 2']);
        Term::create(['term_name'=>'Term 3']);
    }
}
