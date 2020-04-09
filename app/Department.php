<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //Specifying the table focus on
    public $table = "colleges";

    protected $fillable = [
        '	colleges_id', 'department_name', 'department_description',
    ];
}
