<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPaymentDetails extends Model
{
    public $table = "staff_payment_details";

    public $timestamps = false;

    protected $fillable = [
        'staff_payments_id', 'payment_category', 'amount', 
    ];
}
