<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Perfomance extends Model
{
    use HasFactory;

    protected $table = 'student__perfomances';
    
    protected $fillable = ['pupil_id','class_id','term','year','mean'];

    function pupilresultsname(){
        return $this->belongsTo('App\Models\Pupil','pupil_id','id');
    }

    function pupilresultsgrade(){
        return $this->belongsTo('App\Models\Grade','class_id');
    }
}
