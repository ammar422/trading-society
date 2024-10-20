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

    // Accessor for 'image'
    public function getImageAttribute($image)
    {
        return env('APP_URL') . '/uploads/' . $image;
    }

    // Accessor for 'vedio_url'
    public function getVedioUrlAttribute($vedio_url)
    {
        return env('APP_URL') . '/uploads/' . $vedio_url;
    }

    // Relationship with Course model
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}

