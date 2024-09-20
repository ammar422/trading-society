<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Instructor extends Model
{
    use HasFactory , HasApiTokens;

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
}
