<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Instructor extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'description',
        'photo'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'instructor_id', 'id');
    }
}
