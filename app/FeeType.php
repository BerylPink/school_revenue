<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    //Specifying the table focus on
    public $table = "fee_types";

    protected $fillable = [
        'fee_type_name',
    ];

}
