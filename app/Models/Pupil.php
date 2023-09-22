<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    use HasFactory;

    protected $table = 'pupils';
    
    protected $fillable = ['pupil_name','pupil_guardian_name','year_joined','grade_id','pupil_guardian_phone','pupil_reg_number'];

    function pupilgrade(){
        return $this->belongsTo('App\Models\Grade','grade_id','id');
    }

    public function pupilresults()
    {
        return $this->hasMany(Exam_Result::class, 'student_id');
    }
}
