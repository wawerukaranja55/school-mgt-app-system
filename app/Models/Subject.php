<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    
    protected $fillable = ['subject_name','subject_teacher_id'];

    function subjectgrades(){
        return $this->belongsToMany('App\Models\Grade','grade_subject','subject_id','grade_id');
    }

    public function subjectteachers(){
        return $this->belongsTo('App\Models\User','subject_teacher_id','id');
    }
}
