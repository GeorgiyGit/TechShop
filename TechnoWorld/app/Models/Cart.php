<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public static function mergeGuestCart(string $guestSessionId, int $userId): void
    {
        Log::info('Merging guest cart with user ID: ' . $userId);
        $guestCart = self::where('session_id', $guestSessionId)->with('items.product')->first();

        if (!$guestCart || $guestCart->items->isEmpty()) {
            $guestCart?->delete();
            return;
        }

        Log::info('create new cart' . $userId);
        $userCart = self::firstOrCreate(
            ['user_id' => $userId],
            ['session_id' => null]
        );

        foreach ($guestCart->items as $guestItem) {
            Log::info('guest item' . $guestItem->product_id);
            $existing = $userCart->items()->where('product_id', $guestItem->product_id)->first();

            if ($existing) {
                $maxStock = $guestItem->product->stock_left ?? PHP_INT_MAX;
                $existing->update([
                    'quantity' => min($existing->quantity + $guestItem->quantity, $maxStock),
                ]);
            } else {
                $guestItem->update(['cart_id' => $userCart->id]);
            }
        }

        $guestCart->delete();
    }
}
