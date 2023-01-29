<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        "cover",
        "link",
        "over_view"
    ];
    use HasFactory;

    public $timestamps = false;

    public function posts(): HasMany
    {
        return $this->hasMany(post::class);
    }

    public function getAddressWrapAttribute(): string
    {
        $address = '';
        if (!empty($this->address)) {
            $address .= $this->address . ', ';
        }
        if (!empty($this->district)) {
            $address .= $this->district . ', ';
        }
        if (!empty($this->city)) {
            $address .= 'Tp ' . $this->city;
        }
        return $address;
    }

    public function getLocationAttribute(): string
    {
        $location = '';
        if (!empty($this->district)) {
            $location .= $this->district . ', ';
        }
        if (!empty($this->city)) {
            $location .= 'Tp ' . $this->city;
        }
        return $location;
    }

    public function getLogoAttribute($logo): string
    {
        return $logo ?? 'images/company/default_logo_tmh.jpg';
    }
    public function getCoverAttribute($cover): string
    {
        return $cover ?? 'images/company/default_cover.png';
    }

    public function getLinkAttribute($link): string
    {
        return $link ?? 'https://fb.com/tmh30.12';
    }
}
