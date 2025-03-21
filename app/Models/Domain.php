<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\DomainObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
#[ObservedBy([DomainObserver::class])]
class Domain extends Model
{
    /** @use HasFactory<\Database\Factories\DomainFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'description',
    ];

    public function formQuestion(): HasOne
    {
        return $this->hasOne(FormQuestion::class);
    }
}
