<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    public $table = "academic_staffs";

    protected $fillable = [
        'country_id', 'states_id', 'employee_number', 'courses_id', 'firstname', 
        'lastname', 'email', 'gender', 'marital_status', 'dob', 
        'date_joined', 'phone_no', 'address', 'created_by', 'updated_by' 
    ];

}
