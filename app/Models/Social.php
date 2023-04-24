<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    public $table = 'user_socials';
    public $incrementing = false;
    protected $primaryKey = 'key';
    protected $fillable = [
      'user_id',
      'key',
      'value',
    ];
}
