<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_Result extends Model
{
    use HasFactory;

    protected $table = 'exam__results';
    
    protected $fillable = ['class_id','exam_id','student_id','maths','cre','social_stud','sci','eng','kiswa','home_sci',
    'total_marks','mean','year','term'];

    function pupilname(){
        return $this->belongsTo('App\Models\Pupil','student_id','id');
    }

    function pupilexam(){
        return $this->belongsTo('App\Models\Exam','exam_id','id');
    }

    function studentgrade(){
        return $this->belongsTo('App\Models\Grade','class_id','id');
    }
}
