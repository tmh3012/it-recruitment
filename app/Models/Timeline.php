<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    public $table = 'user_timeline';
    public $timestamps = false;
    protected $fillable = [
        "user_id",
        "title",
        "description",
        "start_date",
        "end_date",
        "type"
    ];

    protected static function booted()
    {
        static::creating(function ($object) {
            $object->user_id = user()->id;
        });
    }
}
