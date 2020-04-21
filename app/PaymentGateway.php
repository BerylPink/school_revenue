<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
     //Specifying the table focus on
     public $table = "payment_gateways";

     protected $fillable = [
        'payment_gateway_name',
     ];
}
