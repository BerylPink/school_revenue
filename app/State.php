<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //Specifying the table focus on
    public $table = "states";

    protected $fillable = [
        'StateName',
    ];

    public function student(){
        return $this->hasOne(Student::class);
    }
}
