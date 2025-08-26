<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\WebsiteTypePriceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class WebsiteTypePrice extends Model
{
    /** @use HasFactory<WebsiteTypePriceFactory> */
    use HasFactory;

    protected $fillable = [
        'website_type_id',
        'website_engine',
        'price',
        'size',
    ];

    public function websiteType(): BelongsTo
    {
        return $this->belongsTo(WebsiteType::class);
    }

    protected function casts(): array
    {
        return [
            'price' => 'integer',
        ];
    }
}
