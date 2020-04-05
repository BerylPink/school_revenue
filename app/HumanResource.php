<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HumanResource extends Model
{
    //Specifying the table focus on
    public $table = "human_resource_infos";

    //TO null 'created_at` and `updated_at` if they don't exist on the table
    public $timestamps = false;

    protected $fillable = [
        'users_id', 'states_id', 'firstname', 'lastname', 'phone_no', 'gender', 'address', 'profile_avatar'
    ];
}
