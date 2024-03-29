<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Experience extends Model
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
        "company_id",
        "title",
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

    // Relationship

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class)
            ->select([
                'id',
                'name',
                'logo',
                'city',
                'address',
            ]);
    }

    // Accessor
    // get{Attribute}Attribute

    public function getStartDateAttribute($value): string
    {
        return Carbon::parse($value)->format('M Y');
    }

    public function getEndDateAttribute($value): string
    {
        return Carbon::parse($value)->format('M Y');
    }

}
