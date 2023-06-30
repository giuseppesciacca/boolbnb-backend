<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'iamge',
        'description',
        'rooms',
        'bathrooms',
        'beds',
        'square_meters',
        'address',
        'latitude',
        'longitude',
        'visibility',
    ];

    public static function generateSlug($title) {
        return Str::slug($title, '-');
    }

    //👇 qui sotto tutte le relazioni
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany {
        return $this->hasMany(Message::class);
    }

    public function sponsors(): BelongsToMany {
        return $this->belongsToMany(Sponsor::class);
    }

}
