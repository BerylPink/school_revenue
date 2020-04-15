<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
    //Specifying the table focus on
    public $table = "fee_categories";

    protected $fillable = [
        'fee_type', 'fee_name', 'amount',
    ];


}
