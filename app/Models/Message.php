<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'message',
        'apartment_id'
    ];

    public function apartments(): BelongsTo {
        return $this->belongsTo(Apartment::class);
    }
}
