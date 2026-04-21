<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'session_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'delivery_method',
        'payment_method',
        'country',
        'city',
        'street',
        'house_number',
        'post_code',
        'subtotal',
        'delivery_fee',
        'total',
        'status',
        'placed_at',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'subtotal' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'total' => 'decimal:2',
            'placed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getDeliveryLabelAttribute(): string
    {
        return $this->delivery_method === 'pickup' ? 'Store Pickup' : 'Courier';
    }

    public function getPaymentLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'card' => 'Credit / Debit Card',
            'google_pay' => 'Google Pay',
            default => 'Cash on Delivery / Pickup',
        };
    }
}
