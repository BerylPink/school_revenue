<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPayment extends Model
{
    public $table = "staff_payments";

    protected $fillable = [
        'staff_category', 'academic_staff_id', 'non_academic_staff_id', 'payment_category',  'payment_gateway', 
        'amount', 'created_by', 'updated_by', 
    ];
}
