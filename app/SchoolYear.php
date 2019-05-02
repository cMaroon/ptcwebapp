<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    
    protected $table = 'school_year';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'title'

    ];




}
