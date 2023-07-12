<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentSponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsor_id',
        'apartment_id',
        'start_date',
        'expire_date'
    ];
}
