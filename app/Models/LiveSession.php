<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiveSession extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'duration',
        'image',
        'video',
        'instructor_id',
    ];


    public function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) =>  env('APP_URL') . '/uploads/' . $image
        );
    }

    public function video(): Attribute
    {
        return Attribute::make(
            get: fn($video) =>  env('APP_URL') . '/uploads/' . $video
        );
    }




    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }
}
