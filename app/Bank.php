<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    //Specifying the table focus on
    public $table = "banks";

    protected $fillable = [
        'bank_name', 'account_name', 'account_number',
    ];
}
