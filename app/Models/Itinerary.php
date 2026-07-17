<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Itinerary extends Model
{

    use HasFactory;


    protected $fillable = [

        'trip_id',
        'tanggal',
        'jam',
        'kegiatan',
        'lokasi',
        'catatan'

    ];



    public function trip()
    {

        return $this->belongsTo(Trip::class);

    }

}