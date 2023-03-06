<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigWeb extends Model
{
    use HasFactory;
    public $table = 'config_web';
    protected $fillable = [
        "key",
        "name",
        "value",
        "description",
        "sort",
        "is_display",
        "pin",
    ];
}


