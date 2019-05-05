<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagePayment extends Model
{
    
    protected $table = 'payment_information';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'payment_id_num',
        'sy',
        'semester',
        'yearlevel',
        'payment_form_id',
        'tuition_fee',
        'registration_fee',
        'library_fee',
        'medical_fee',
        'cultural_fee',
        'athletic_fee',
        'bookrental_fee',
        'laboratory_fee',
        'penalty_fee',
        'other_fee',
        'total_amount_fee',
        'assessed_by',
        'prelim_or_num',
        'prelim_amount_paid',
        'prelim_paid_date',
        'prelim_issued_by',
        'midterm_or_num',
        'midterm_amount_paid',
        'midterm_paid_date',
        'midterm_issued_by',
        'finals_or_num',
        'finals_amount_paid',
        'finals_paid_date',
        'finals_issued_by',

    ];

    public function pyFID()
    {
        return $this->belongsTo('App\ManageEnrollment','payment_form_id','enr_form_id');
    }

    public function pySI()
    {
        return $this->belongsTo('App\Student','payment_id_num','id_num');
    }

    public function pysy()
    {
        return $this->belongsTo('App\SchoolYear','sy');
    }

    public function pysem()
    {
        return $this->belongsTo('App\Semester','semester');

    }

    public function pyyl()
    {
        return $this->belongsTo('App\YearLevel','yearlevel');

    }




}
