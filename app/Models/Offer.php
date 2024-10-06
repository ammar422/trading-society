<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;


    protected $fillable = [
        'instructor_id',
        'order_status',
        'pair',
        'price',
        'order_type',
        'sl',
        'tp1',
        'tp2',
        'tp3',
        'tp4',
        'tp5',
        'chart',
        'description'
    ];



    public function chart(): Attribute
    {
        return Attribute::make(
            get: fn($chart) =>  env('APP_URL') . '/uploads/' . $chart
        );
    }


    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
