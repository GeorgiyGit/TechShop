<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'brand',
        'name',
        'short_description',
        'description',
        'price',
        'category_id',
        'sort_order',
        'popularity_score',
        'stock_left',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'category_id' => 'integer',
            'sort_order' => 'integer',
            'popularity_score' => 'integer',
            'stock_left' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function characteristics(): HasMany
    {
        return $this->hasMany(ProductCharacteristic::class)->orderBy('position');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('position');
    }

    public function firstImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->orderBy('position');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
