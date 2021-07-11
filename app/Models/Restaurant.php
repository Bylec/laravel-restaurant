<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    protected $fillable = [
        'name'
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }

    public function numberOfSpotsLeft(): int
    {
        $spotsLeft = $this->employee_limit - $this->employees()->count();
        return $spotsLeft > 0 ? $spotsLeft : 0;
    }
}
