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
        'image',
        'description',
        'price',
        'rooms',
        'bathrooms',
        'beds',
        'square_meters',
        'address',
        'latitude',
        'longitude',
        'visibility',
    ];

    //method of converting attributes to common data types.
    protected $casts = [
        'image' => 'array'
    ];

    public static function generateSlug($title) {
        return Str::slug($title, '-');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany {
        return $this->hasMany(Message::class);
    }

    public function sponsors(): BelongsToMany {
        return $this->belongsToMany(Sponsor::class);
    }

    public function services(): BelongsToMany {
        return $this->belongsToMany(Service::class);
    }

    public function views(): HasMany {
        return $this->hasMany(View::class);
    }

}
