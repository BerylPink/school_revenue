<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //Specifying the table focus on
    public $table = "courses";

    protected $fillable = [
        'colleges_id', 'departments_id', 'course_name', 'course_description',
    ];
}
