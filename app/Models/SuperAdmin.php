<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SuperAdmin extends Authenticatable
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'password',
        'photo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function photo(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return env('APP_URL') . $value;
            }
        );
    }
}
