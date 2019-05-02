<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    
    protected $table = 'curriculum_information';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'semester','sy','curr_year','curr_program_id','curr_course_id','curr_section_id','sched_days','sched_time','sched_room','curr_id_ins'

    ];

    public function currprograms()
    {
        return $this->belongsTo('App\ManageProgram','curr_program_id');
    }

    public function currinstructor()
    {
        return $this->belongsTo('App\Instructor','curr_id_ins');
    }

    public function currsy()
    {
        return $this->belongsTo('App\SchoolYear','sy');
    }

    public function currcourses()
    {
        return $this->belongsTo('App\Courses','curr_course_id');

    }

    public function currsemester()
    {
        return $this->belongsTo('App\Semester','semester');

    }

    public function curryearlevel()
    {
        return $this->belongsTo('App\YearLevel','curr_year');

    }

    public function currsection()
    {
        return $this->belongsTo('App\Section','curr_section_id');

    }



}
