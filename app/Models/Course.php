<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'description',
        'total_hours',
        'instructor_id',
        'category_id',
        'photo'
    ];



    // public function photo(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($photo) =>  env('APP_URL') . '/uploads/' . $photo
    //     );
    // }




    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')->withTimestamps();
    }

    public function courseVedios(): HasMany
    {
        return $this->hasMany(CourseVedio::class, 'course_id', 'id');
    }
}
