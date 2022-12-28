<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

//    protected $appends = ['full_city'];
    protected $fillable = [
        "name",
        "address",
        "address2",
        "district",
        "city",
        "country",
        "zipcode",
        "phone",
        "number_of_employees",
        "mission",
        "introduction",
        "email",
        "logo",
        "cover"
    ];
    use HasFactory;
    public $timestamps = false;

    public function getLocationAttribute(): string
    {
        $location = '';
        if (!empty($this->address)) {
            $location .= $this->address .', ';
        }
         if(!empty($this->district)){
            $location .= $this->district .', ';
        }
         if(!empty($this->city)){
            $location .= 'Tp '. $this->city;
        }
        return $location;
    }
}
