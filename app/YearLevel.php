<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearLevel extends Model
{
    
    protected $table = 'yearlevel_info';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'title'

    ];




}
