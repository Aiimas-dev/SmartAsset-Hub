<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Trip extends Model
{

    use HasFactory;



    protected $fillable = [

        'user_id',
        'destination_name',
        'destination_type',
        'transportation',
        'accommodation',
        'travel_style',
        'departure_date',
        'return_date',
        'has_medication',
        'notes'

    ];




    /*
    |--------------------------------------------------------------------------
    | Relasi User
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);

    }





    /*
    |--------------------------------------------------------------------------
    | Relasi Packing List
    |--------------------------------------------------------------------------
    */

    public function packingLists(): HasMany
    {

        return $this->hasMany(PackingList::class);

    }





    /*
    |--------------------------------------------------------------------------
    | Relasi Jadwal Perjalanan
    |--------------------------------------------------------------------------
    */

    public function itineraries(): HasMany
    {

        return $this->hasMany(Itinerary::class);

    }



}