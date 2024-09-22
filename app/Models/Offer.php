<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
