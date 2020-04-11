<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $table = "user_roles";

    protected $fillable = [
        'userrole_name', 'userrole_description',
    ];
}
