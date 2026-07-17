<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackingList extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id',
        'item_name',
        'category',
        'quantity',
        'is_checked',
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}