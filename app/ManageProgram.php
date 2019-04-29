<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageProgram extends Model
{
    
    protected $table = 'program_information';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'program_code','descriptive_title','adivising_id'

    ];

    public function programscurr()
    {
        return $this->hasMany('App\Curriculum');
    }

    public function aID()
    {
        return $this->belongsTo('App\Instructor','advising_id');
    }




}
