<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'link',
        'type',
        'cover_letter',
    ];
    public $timestamps = false;

//    protected static function booted()
//    {
//        static::creating(function ($object) {
//            $object->user_id = 3;
//        });
//    }
}
