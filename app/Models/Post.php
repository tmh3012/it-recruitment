<?php

namespace App\Models;

use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostStatusEnum;
use App\Enums\SystemCacheKeyEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


class Post extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'job_title',
        'status',
        "district",
        "city",
        "remote",
        "can_parttime",
        "min_salary",
        "max_salary",
        "currency_salary",
        "job_description",
        "job_requirement",
        "job_benefit",
        "start_date",
        "end_date",
        "number_applicants",
        "slug",
    ];


    protected static function booted()
    {
        static::creating(function ($object) {
            $object->user_id = user()->id;
            $object->status = PostStatusEnum::getStatusByRole();
        });
        static::saved(static function ($object) {
            $newCities = $object->cities;
            $arr = explode(',', $newCities);
            $arrCities = getAndCachePostCities();
            foreach ($arr as $item) {
                if (in_array($item, $arrCities)) {
                    continue;
                }
                $arrCities[] = $item;
            }
            cache()->put(SystemCacheKeyEnum::POST_CITIES, $arrCities);
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


    public function languages()
    {
        return $this->morphToMany(
            Language::class,
            'object',
            ObjectLanguage::class,
            'object_id',
            'language_id',
        );
    }


    public function getStatusTypeStringAttribute(): string
    {
        $key = strtolower(PostStatusEnum::getKey($this->status));
        return __('frontPage.' . $key);
    }

    public function getEnumCurrencySalaryAttribute(): string
    {
        return PostCurrencySalaryEnum::getKey($this->currency_salary);
    }

    public function getRangeSalaryAttribute(): string
    {
        $currencySalary = $this->currency_salary;
        if (!is_null($this->min_salary)) {
            $minSalary = $this->min_salary;
        }
        if (!is_null($this->max_salary)) {
            $maxSalary = $this->max_salary;
        }
        if (!empty($minSalary) && !empty($maxSalary)) {
            return $minSalary . ' - ' . $maxSalary . ' ' . $currencySalary;
        }
        if (!empty($minSalary)) {
            return "Min offer " . $this->min_salary . ' ' . $currencySalary;
        }
        if (!empty($maxSalary)) {
            return "Max offer " . $this->max_salary . ' ' . $currencySalary;
        }
        return 'Agreement';
    }

    public function getDeadlineSubmitAttribute(): string
    {
        return Carbon::parse($this->end_date)->format('d/m/Y');
    }

    public function getPostLocationAttribute(): string
    {
        return $this->district . ', ' . $this->city;
    }

    public function getWorkingTimeAttribute(): string
    {
        return $this->can_parttime === 1 ? __('frontPage.part_time') : __('frontPage.full_time');
    }

    public function getMinSalaryAttribute($value)
    {
        $key_currency_salary = PostCurrencySalaryEnum::getKey($this->currency_salary);
        $rate = Config::getByKey($key_currency_salary);

        return $value * $rate === 0 || null ? null : $value * $rate;
    }

    public function getMaxSalaryAttribute($value)
    {
        $key_currency_salary = PostCurrencySalaryEnum::getKey($this->currency_salary);
        $rate = Config::getByKey($key_currency_salary);
        return $value * $rate === 0 || null ? null : $value * $rate;
    }

    public function getSalaryAttribute()
    {
        $currency_salary_post = $this->currency_salary;
        $key_currency_salary = PostCurrencySalaryEnum::getKey($currency_salary_post);
        $locale = PostCurrencySalaryEnum::getLocaleByVal($currency_salary_post);
        $format = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);


        if (!is_null($this->min_salary)) {
            $salary = $this->min_salary;
            $minSalary = $format->formatCurrency($salary, $key_currency_salary);
        }

        if (!is_null($this->max_salary)) {
            $salary = $this->max_salary;
            $maxSalary = $format->formatCurrency($salary, $key_currency_salary);
        }

        if (!empty($minSalary) && !empty($maxSalary)) {
            return $minSalary . ' - ' . $maxSalary;
        }
        if (!empty($minSalary)) {
            return __('frontPage.minOffer') . ' ' . $minSalary;
        }
        if (!empty($maxSalary)) {
            return __('frontPage.maxOffer') . ' ' . $maxSalary;
        }
        return __('frontPage.agreement');

    }

    public function getLocationAttribute($value): string
    {
        $location = '';
        if (!empty($this->district) && !empty($this->city)) {
            $location = "{$this->district}, {$this->city}";
        } else if (empty($this->district)) {
            $location = $this->city;
        } else {
            $location = $this->district;
        }
        return $location;
    }


    public function scopePostReceived($query)
    {
        return $query->where('end_date', '>=', now());
    }

    public function canApply($slug): bool
    {
        $post = Post::query()
            ->where('slug', '=', $slug)
            ->postReceived()
            ->first();
        return !empty($post) ?? false;
    }


    public function scopePostApproved($query)
    {
        return $query
            ->with([
                'languages',
                'company' => function ($q) {
                    $q->select([
                        'id',
                        'name',
                        'logo',
                    ]);
                },
            ])
            ->where('status', PostStatusEnum::ADMIN_APPROVED)
            ->latest();
    }

    public function scopeJobsPage($query, $filters)
    {
        return $query
            ->when(isset($filters['ft_key_word']), function ($q) use ($filters) {
                $q->where('job_title', 'like', '%' . $filters['ft_key_word'] . '%');
            })
            ->when(isset($filters['ft_city']), function ($q) use ($filters) {
                $q->orWhere('city', 'like', '%' . $filters['ft_city'] . '%');
            })
            ->when(isset($filters['fr_min_salary']), function ($q) use ($filters) {
                $q->where(function ($q) use ($filters) {
                    $q->orWhere('min_salary', '>=', $filters['fr_min_salary']);
                    $q->orWhereNull('min_salary');
                });
            })
            ->when(isset($filters['fr_max_salary']), function ($q) use ($filters) {
                $q->where(function ($q) use ($filters) {
                    $q->orWhere('max_salary', '<=', $filters['fr_max_salary']);
                    $q->orWhereNull('max_salary');
                });
            })
            ->when(isset($filters['fr_remote']), function ($q) use ($filters) {
                $q->where('remote', $filters['fr_remote']);
            })
            ->when(isset($filters['fr_can_part_time']), function ($q) use ($filters) {
                $q->where('can_parttime', $filters['fr_can_part_time']);
            })
            ->postApproved()
//            ->postReceived()
            ->orderByDesc('is_pinned')
            ->orderByDesc('id');
    }

    public function scopeRelatedPosts($query, $postId, $companyId)
    {
        return $query
            ->when(isset($companyId), function ($q) use ($companyId, $postId) {
                $q->where(function ($q) use ($companyId, $postId) {
                    $q->where('company_id', $companyId);
                    $q->where('id', '!=', $postId);
                });
            })
            ->latest()
//            ->postReceived()
            ->get();

    }
}
