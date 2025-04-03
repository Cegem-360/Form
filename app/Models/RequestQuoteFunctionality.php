<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuoteFunctionality extends Model
{
    /** @use HasFactory<\Database\Factories\RequestQuoteFunctionalityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function requestQuotes()
    {
        return $this->belongsToMany(RequestQuote::class);
    }
}
