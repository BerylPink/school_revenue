<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPaymentHistory extends Model
{
     //Specifying the table focus on
     public $table = "student_payment_histories";

     protected $fillable = [
         'user_id', 'academic_session', 'academic_semester', 'fee_type', 'fee_category', 'payment_gateway', 'amount_paid',
     ];
}
