<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Instructor extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'description',
        'photo',
        'status',
        'video'
    ];


    public function photo(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return env('APP_URL') . '/uploads/' . $value;
            }
        );
    }

    public function video(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return env('APP_URL') . '/uploads/' . $value;
            }
        );
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeActiveInstructors()
    {
        return $this->where('status', 'active');
    }



    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'instructor_id', 'id');
    }
}
