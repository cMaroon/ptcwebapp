<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageEnrollment extends Model
{
    
    protected $table = 'enrollment_information';
    // public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'enr_form_id','sy','semester','yearlevel','enr_id_num','enr_program_id','total_course_unit'

    ];

    public function enrollprograms()
    {
        return $this->belongsTo('App\ManageProgram','enr_program_id');
    }

    public function studinfo()
    {
        return $this->belongsTo('App\Student','enr_id_num','id_num');
    }
}
