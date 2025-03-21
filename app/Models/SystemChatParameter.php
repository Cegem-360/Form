<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OpenAIRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemChatParameter extends Model
{
    /** @use HasFactory<\Database\Factories\SystemChatParameterFactory> */
    use HasFactory;

    protected $fillable = [
        'form_field_name',
        'form_field_id',
        'role',
        'content',
    ];

    protected $casts = [
        'role' => OpenAIRole::class,
    ];
}
