<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Company extends Model
{

    protected $appends = ['location'];
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

    protected static function booted()
    {
//        static::creating(function ($object) {
//            $object->user_id = user()->id;
//        });
    }

    //---------------
    // Relationship

    public function posts(): HasMany
    {
        return $this->hasMany(post::class);
    }

    public function companies(): MorphTo
    {
        return $this->morphTo();
    }

    // --------------------
    // Accessor
    // get{Attribute}Attribute

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
        $src = $logo ?? 'images/company/default_logo_tmh.jpg';
        return asset('storage/'.$src);
    }

    public function getCoverAttribute($cover): string
    {
       $src = $cover ?? 'images/company/default_cover.png';
        return asset('storage/'.$src);
    }

    public function getLinkAttribute($link): string
    {
        return $link ?? 'https://fb.com/tmh30.12';
    }

    // query scope
    public function scopeCheckCompanyExist($query, $companyName)
    {
        return $query
            ->where('name', $companyName)
            ->exists();
    }
}
