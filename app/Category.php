<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Specifying the table focus on
    public $table = "categories";

    protected $fillable = [
        'category_name', 'category_description',
    ];

    // public function nonAcademicStaffs() 
    // {
    //     return $this->hasMany(NonAcademic::class);
    // }
}
