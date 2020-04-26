<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
     //Specifying the table focus on
     public $table = "expense_categories";

     protected $fillable = [
         'expense_cat_name', 'expense_cat_description',
     ];
}
