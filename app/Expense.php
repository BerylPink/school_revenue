<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //Specifying the table focus on
    public $table = "expenses";

    protected $fillable = [
        'expense_categories_id', 'expense_name', 'amount', 'expense_description', 'created_by', 'updated_by'
    ];

}
