<?php

namespace App\Models;

use App\Enums\AppConfigTypeEnum;
use App\Enums\SystemCacheKeyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Config extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $appends = ['configType'];
    protected $fillable = [
        'key',
        'value',
        'type',
        'is_public',
        'description',
    ];

    public function configsWeb(): HasMany
    {
        return $this->hasMany(ConfigWeb::class, 'key', 'key')->orderBy('sort', 'asc');
    }

    public static function getAndCache($isPublic): array
    {
        return cache()->remember(
            SystemCacheKeyEnum::CONFIG . $isPublic,
            '60*60*24*30',
            function () use ($isPublic) {
                $data = self::query()
                    ->where('is_public', $isPublic)
                    ->get();
                $arr = [];
                foreach ($data as $each) {
                    $arr[$each->key] = $each->value;
                }
                return $arr;
            }
        );

    }

    public static function getByKey($key)
    {
        return cache()->remember(
            SystemCacheKeyEnum::CONFIG . $key,
            '60*60*24*30',
            function () use ($key) {
                return self::query()
                    ->where('key', $key)
                    ->value('value');
            }
        );
    }

    public function getConfigTypeAttribute(): string
    {
        return AppConfigTypeEnum::getKey($this->type);
    }
}
