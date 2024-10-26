<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasBroadcastChannel
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'broker',
        'broker_registration_email',
        'country',
        'id_number',
        'id_photo_front',
        'id_photo_back',
        'selfie_with_id',
        'sponsor_id',
        'is_subscribed',
        'profile_image',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function profileImage(): Attribute
    {
        return new Attribute(
            get: fn($value) => env('APP_URL') . '/uploads/' . $value
        );
    }


    /**
     * Get the channel name for the model.
     *
     * @return string
     */

    public function broadcastChannel()
    {
        return 'App.Models.User.' . $this->id;
    }


    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id', 'id', 'id')->withTimestamps();
    }
}
