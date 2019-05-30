<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidencyCategory extends Model
{
    
    protected $table = 'residency_category';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'title','description'

    ];




}
