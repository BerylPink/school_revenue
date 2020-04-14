<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //Specifying the table focus on
    public $table = "countries";

    protected $fillable = [
        'CountryName',	'Iso3', 'PhoneCode'
    ];

    public function student(){
        return $this->hasOne(Student::class);
    }
}
