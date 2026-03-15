<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
     protected $fillable = [
        'user_id', 'brand', 'model', 'body_type', 
        'max_weight', 'length', 'width', 'height', 
        'current_location', 'is_available'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
