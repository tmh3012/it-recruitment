<?php

namespace App\Models;

use App\Enums\TimelineTypeEnum;
use Carbon\Carbon;
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

    protected $appends = ['timelineStart', 'timelineEnd',];

    protected static function booted()
    {
        static::creating(function ($object) {
            $object->user_id = user()->id;
        });
    }

    public function getTimelineStartAttribute(): string
    {
        return Carbon::parse($this->start_date)->format('m/Y');
    }

    public function getTimelineEndAttribute(): string
    {
        return Carbon::parse($this->end_date)->format('m/Y');
    }
    public function getTypeAttribute($value): string
    {
        return strtolower(TimelineTypeEnum::getKey($value));
    }
}
