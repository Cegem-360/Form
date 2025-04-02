<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OpenAIRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $form_field_name
 * @property int $form_field_id
 * @property OpenAIRole $role
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\SystemChatParameterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereFormFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereFormFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
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
