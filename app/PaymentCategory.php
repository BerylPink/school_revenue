<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCategory extends Model
{
    //Specifying the table focus on
    public $table = "payment_categories";

    protected $fillable = [
        'payment_category_name', 'payment_category_description',
    ];
}
