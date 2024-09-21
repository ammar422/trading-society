<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseVedio extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'vedio_url',
        'time',
        'description',
        'image',
    ];



    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
