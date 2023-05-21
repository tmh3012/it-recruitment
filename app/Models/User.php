<?php

namespace App\Models;

use App\Enums\TimelineTypeEnum;
use App\Enums\UserRoleEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function education(): HasMany
    {
        return $this->hasMany(Education::class)
            ->orderByDesc('end_date');
    }

    public function experiences(): HasMany
    {
        $data = $this->hasMany(Experience::class)
            ->with('company')
            ->orderByDesc('start_date');
        foreach ($data as $each) {
            $each->company->append('location');
        }
        return $data;
    }

    public function socials(): HasMany
    {
        return $this->hasMany(Social::class)
            ->select([
                'user_id',
                'key',
                'value',
            ]);
    }

    public function skills(): MorphToMany
    {
        return $this->morphToMany(
            Language::class,
            'object',
            ObjectLanguage::class,
            'object_id',
            'language_id',
        );
    }

    public function fileCv(): HasOne
    {
        return $this->hasOne(File::class,);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function followCompany(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_user', 'user_id', 'company_id')
            ->withTimestamps();
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class,);
    }

    public function getRoleNameAttribute()
    {
        return UserRoleEnum::getKeys($this->role)[0];
    }

    public function getAvatarAttribute($value)
    {
        if ($this->type === UserTypeEnum::OAUTH_USER) {
            $avatar = $value;
        } else {
            $avatar = !empty($value) ? asset('storage/' . $value) : $value;
        }
        return $avatar;
    }

    public function getCoverAttribute($value)
    {
        return $this->type === UserTypeEnum::OAUTH_USER ? $value : asset('storage/' . $value);
    }

    public function getEmailContactAttribute()
    {
        $emailFromSocial = $this->socials()
            ->where('key', 'google')
            ->firstOrFail()
            ->toArray();
        $emailFromSocial = $emailFromSocial['value'];
        return $emailFromSocial ?? $this->email;
    }

    public static function checkPostSaved($postId): bool
    {
        return auth()->check() ? user()->posts()->where('post_id', '=', $postId)->exists() : false;
    }

    public static function checkFollow($companyId): bool
    {
        return auth()->check() ? user()->followCompany()->where('company_id', '=', $companyId)->exists() : false;
    }

    //query scope

}
