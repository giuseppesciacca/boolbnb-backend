<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ApartmentSponsor extends Model
{
    use HasFactory;

    protected $table = 'apartment_sponsor'; //Se il nome del modello o della tabella è diverso, potete specificarlo manualmente nel modello utilizzando la proprietà protected $table:

    public function apartment(): BelongsToMany
    {
        return $this->belongsToMany(ApartmentSponsor::class);
    }

    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(ApartmentSponsor::class);
    }


    protected $fillable = [
        'sponsor_id',
        'apartment_id',
        'start_date',
        'expire_date'
    ];
}
