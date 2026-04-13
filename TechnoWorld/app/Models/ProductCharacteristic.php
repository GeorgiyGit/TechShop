<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCharacteristic extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'value',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
            'position' => 'integer',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
