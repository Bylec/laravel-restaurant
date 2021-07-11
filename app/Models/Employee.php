<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    const EMPLOYMENT_LIMIT = 3;

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class);
    }

    public function canWorkInRestaurant(Restaurant $restaurant): bool
    {
        return $this->restaurants()->count() < self::EMPLOYMENT_LIMIT && !$this->restaurants->contains($restaurant->id);
    }
}
