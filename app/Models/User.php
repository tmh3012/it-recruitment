<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'name', 'email', 'password', 'role',
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
