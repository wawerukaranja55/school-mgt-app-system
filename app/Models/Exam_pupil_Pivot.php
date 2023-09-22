<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_pupil_Pivot extends Model
{
    use HasFactory;

    protected $table = 'exam_pupils';
    
    protected $fillable = ['pupil_id','exam_id','total_marks','mean','year','term'];
}

