<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
     //Specifying the table focus on
     public $table = "payment_gateways";

     protected $fillable = [
        'gateway_name',
     ];
}
