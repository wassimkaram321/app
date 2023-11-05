<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    protected $table = "users";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address',
        'phone',
        'email_verified_at',
        'last_login_at',
        'role_id',
        'gender',
        'status',
        'fcm_token',
        'city_id'
    ];

    protected $casts = [
        'first_name'        => 'string',
        'last_name'         => 'string',
        'email'             => 'string',
        'password'          => 'hashed',
        'address'           => 'string',
        'phone'             => 'integer',
        'email_verified_at' => 'datetime',
        'last_login_at'     => 'datetime',
        'role_id'           => 'string',
        'gender'            => 'string',
        'status'            => 'boolean',
        'fcm_token'         => 'string',
        'city_id'           => 'integer',
    ];

    protected $hidden = [
        'password',
        'deleted_at',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getUserNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
