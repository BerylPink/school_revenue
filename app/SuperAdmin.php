<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    //Specifying the table focus on
    public $table = "super_admin_infos";

    //TO null 'created_at` and `updated_at` if they don't exist on the table
    public $timestamps = false;

    protected $fillable = [
        'users_id', 'firstname', 'lastname', 'phone_no', 'address', 'profile_avatar'
    ];
}
