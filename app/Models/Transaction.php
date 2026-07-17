<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'equipment_id',
        'borrower',
        'borrow_date',
        'return_date',
        'status',
    ];



    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

}