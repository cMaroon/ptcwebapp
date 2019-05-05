<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageEnrollment extends Model
{
    
    protected $table = 'enrollment_information';
    // public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'enr_form_id','sy','semester','yearlevel','section','enr_id_num','enr_program_id','total_course_unit'

    ];

    public function enrollprograms()
    {
        return $this->belongsTo('App\ManageProgram','enr_program_id');
    }

    public function studinfo()
    {
        return $this->belongsTo('App\Student','enr_id_num','id_num');
    }
    
    public function enrollassoc()
    {
        return $this->belongsTo('App\EnrollmentAssoc','enr_form_id');
    }

    public function enrsy()
    {
        return $this->belongsTo('App\SchoolYear','sy');
    }

    public function enrsem()
    {
        return $this->belongsTo('App\Semester','semester');

    }

    public function enryearlevel()
    {
        return $this->belongsTo('App\YearLevel','yearlevel');

    }

    public function enrsection()
    {
        return $this->belongsTo('App\Section','section');

    }
}
