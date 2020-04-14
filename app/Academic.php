<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    public $table = "academic_infos";

    //TO null 'created_at` and `updated_at` if they don't exist on the table
    public $timestamps = false;

    protected $fillable = [
        'college_id', 'department_id', 'course_id', 'country_id', 'state_id', 'firstname', 
        'lastname', 'email', 'phone_no', 'gender', 'marital_status', 'address', 'employee_number', 'joined_date'
    ];

}
