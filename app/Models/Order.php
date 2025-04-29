<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StripeCurrency;
use App\Enums\TransactionStatus;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'stripe_order_id',
        'amount',
        'currency',
        'status',
        'customer_email',
        'customer_name',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'currency' => StripeCurrency::class,
            'status' => TransactionStatus::class,
        ];
    }
}
