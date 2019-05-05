<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentAssoc extends Model
{
    
    protected $table = 'assoc_enr_cou';
    // public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'assoc_form_id','assoc_curr_id'

    ];

    public function assocformid()
    {
        return $this->belongsTo('App\ManageEnrollment','assoc_form_id');
    }

    public function assoccurrid()
    {
        return $this->belongsTo('App\Curriculum','assoc_curr_id');
    }

    
}
