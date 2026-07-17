<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;


#[Fillable([
    'name',
    'email',
    'password',
    'phone',
    'gender',
    'birth_date',
    'address',
    'photo'
])]

#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;


    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

        ];
    }



    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

}