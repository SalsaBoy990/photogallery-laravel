<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Casts\HtmlSpecialCharsCast;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'sex',
        'avatar_image',
        'short_bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name'              => HtmlSpecialCharsCast::class,
        'email'             => HtmlSpecialCharsCast::class,
        'email_verified_at' => 'datetime',
    ];

    /**
     * Users' roles
     * 
     * @var array
     */
    public const ROLES = [
        1 => 'admin',
        2 => 'customer'
    ];

    /**
     * Accessor for the user's role.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => self::ROLES[$value]
        );
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }


    /**
     * User has many galleries
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * User has many tags
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
