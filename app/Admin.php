<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //Specifying the table focus on
    public $table = "admin_infos";

    //TO null 'created_at` and `updated_at` if they don't exist on the table
    public $timestamps = false;

    protected $fillable = [
        'users_id', 'college_id', 'state_id', 'firstname', 'lastname', 'phone_no', 'gender', 'address', 'profile_avatar'
    ];

   
}
