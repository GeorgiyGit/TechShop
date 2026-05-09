<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'country',
        'city',
        'street',
        'house_number',
        'postal_code',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
