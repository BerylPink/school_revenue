<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    //Specifying the table focus on
    public $table = "colleges";

    protected $fillable = [
        'college_name', 'college_description',
    ];

}

