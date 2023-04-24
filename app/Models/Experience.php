<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "company_id",
        "position",
        "description",
        "start_date",
        "end_date"
    ];

    protected static function booted()
    {
        static::creating(function ($object) {
            $object->user_id = user()->id;
        });
    }
}
