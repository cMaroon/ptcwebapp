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
        'catergory',
        'tuition_fee',
        'registration_fee',
        'library_fee',
        'medical_fee',
        'cultural_fee',
        'athletic_fee',
        'bookrental_fee',
        'laboratory_fee',
        'computer_fee',
        'penalty_fee',
        'idval_fee',
        'guidance_fee',
        'careerdev_fee',
        'ptccup_fee',
        'studenthb_fee',
        'insurance_fee',
        'ssc_fee',
        'total_amount_fee',
        'balance_fee',
        'assessed_by',
        'downpayment_topaid',
        'adding_or_num',
        'adding_amount_paid',
        'adding_paid_date',
        'adding_issued_by',
        'downpayment_or_num',
        'downpayment_amount_paid',
        'downpayment_paid_date',
        'downpayment_issued_by',
        'prelim_topaid',
        'prelim_or_num',
        'prelim_amount_paid',
        'prelim_paid_date',
        'prelim_issued_by',
        'midterm_topaid',
        'midterm_or_num',
        'midterm_amount_paid',
        'midterm_paid_date',
        'midterm_issued_by',
        'finals_topaid',
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

    public function pycat()
    {
        return $this->belongsTo('App\Category','category');
    }

    




}
