<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseVedio extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'vedio_url',
        'duration',
        'description',
        'image',
        'order',
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) =>  env('APP_URL') . '/uploads/' . $image
        );
    }

    public function vedio_url(): Attribute
    {
        return Attribute::make(
            get: fn($vedio_url) =>  env('APP_URL') . '/uploads/' . $vedio_url
        );
    }



    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
