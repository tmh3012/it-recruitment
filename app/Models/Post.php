<?php

namespace App\Models;

use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostStatusEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'job_title',
        'city',
        'status',
    ];


    protected static function booted()
    {
        static::creating(function ($object) {
            $object->user_id = 3;
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'job_title'
            ]
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getCurrencySalaryAttribute($value)
    {
        return PostCurrencySalaryEnum::getKey($value);
    }

    public function getRangeSalaryAttribute()
    {
        is_null($this->min_salary) ? $minSalary = $this->min_salary : $minSalary ='';
        is_null($this->max_salary) ?  $maxSalary = $this->max_salary :  $maxSalary = '';
        return $minSalary .$maxSalary;
    }

    public function getStatusAttribute($value)
    {
        return PostStatusEnum::getKey($value);
    }

}
