<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //Specifying the table focus on
    public $table = "students";

    //TO null 'created_at` and `updated_at` if they don't exist on the table
    public $timestamps = false;
    
    protected $fillable = [
        'users_id',	'countries_id', 'states_id', 'colleges_id', 'departments_id', 'registration_number', 'firstname', 'lastname', 'gender', 'dob', 'phone_no', 'address', 'profile_avatar',
    ];

    public function country(){
        return $this->BelongsTo(Country::class);
    } 

    public function state(){
        return $this->BelongsTo(State::class);
    }

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
