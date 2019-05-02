<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    
    protected $table = 'courses_information';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'course_code','descriptive_title','lec_hr','lab_hr','course_unit','course_pre_req'

    ];

    public function coursesCurr()
    {
        return $this->hasMany('App\Curriculum');
    }

}
