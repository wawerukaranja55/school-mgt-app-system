<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam__results', function (Blueprint $table) {
            $table->id();
            $table->integer('maths');
            $table->integer('eng');
            $table->integer('kiswa');
            $table->integer('home_sci');
            $table->integer('sci');
            $table->integer('cre');
            $table->integer('social_stud');
            $table->integer('exam_id');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->integer('total_marks');
            $table->integer('mean');
            $table->integer('term');
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam__results');
    }
};
