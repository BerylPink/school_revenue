<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonAcademic extends Model
{
    public $table = "non_academic_staffs";

    protected $fillable = [
        'country_id', 'states_id', 'category_id', 'employee_number',  'firstname', 
        'lastname', 'email', 'phone_no', 'gender', 'marital_status', 'dob', 'date_joined', 'phone_no', 'address', 'created_by', 'updated_by', 
    ];

    public function categories(){

        // return $this->belongsTo(Category::class, 'category_id');
        return $this->belongsTo(Category::class, 'id');
    }

    public function category(){

        return $this->belongsTo(Category::class, 'id');
    }

}
