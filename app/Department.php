<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //Specifying the table focus on
    public $table = "departments";

    protected $fillable = [
        'colleges_id', 'department_name', 'department_description',
    ];

    public function college(){
        return $this->BelongsTo(College::class);
    }
}
