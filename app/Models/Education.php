<?php

namespace App\Models;

use App\Enums\EducationTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $dates = [
        "start_date",
        "end_date"
    ];
    protected $dateFormat = "Y-m-d(1)";
    protected $fillable = [
        "user_id",
        "title",
        "major",
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

    public function getStartDateAttribute($value): string
    {
        return Carbon::parse($value)->format('M Y');
    }

    public function getEndDateAttribute($value): string
    {
        return Carbon::parse($value)->format('M Y');
    }
//    public function getTypeAttribute($value): string
//    {
//        return strtolower(EducationTypeEnum::getKey($value));
//    }
}
