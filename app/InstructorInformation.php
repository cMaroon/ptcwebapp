<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructorInformation extends Model
{
    protected $table = 'instructor_information';

    //Database Tables
    protected $fillable = [
        'user_id','firstname', 'middlename' ,'lastname','suffixname',
        'sex','civil_status','citizenship','birthplace','religion','dob',
        'ca_st_num','ca_st_name','ca_subd','ca_brgy','ca_city','ca_province','ca_zipcode',
        'cd_telno','cd_mobno','emergency_contact','contact_number'

    ];

    public function instructorUserID()
    {
        return $this->belongsTo('App\Instructor','user_id');
    }


}
