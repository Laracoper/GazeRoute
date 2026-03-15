<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cargo extends Model
{
    protected $fillable = [
        'user_id',
        'route_from',
        'route_to',
        'pickup_date',
        'weight',
        'volume',
        'length',
        'price',
        'description',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'pickup_date' => 'date', // Laravel автоматически превратит строку из БД в объект Carbon
    ];
}
