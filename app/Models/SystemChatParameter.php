<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OpenAIRole;
use Database\Factories\SystemChatParameterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $form_field_name
 * @property int $form_field_id
 * @property OpenAIRole $role
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static SystemChatParameterFactory factory($count = null, $state = [])
 * @method static Builder<static>|SystemChatParameter newModelQuery()
 * @method static Builder<static>|SystemChatParameter newQuery()
 * @method static Builder<static>|SystemChatParameter query()
 * @method static Builder<static>|SystemChatParameter whereContent($value)
 * @method static Builder<static>|SystemChatParameter whereCreatedAt($value)
 * @method static Builder<static>|SystemChatParameter whereFormFieldId($value)
 * @method static Builder<static>|SystemChatParameter whereFormFieldName($value)
 * @method static Builder<static>|SystemChatParameter whereId($value)
 * @method static Builder<static>|SystemChatParameter whereRole($value)
 * @method static Builder<static>|SystemChatParameter whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class SystemChatParameter extends Model
{
    /** @use HasFactory<SystemChatParameterFactory> */
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
