<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\SystemChatParameter;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Collection;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    public Collection $systemChatParameters;

    public SystemChatParameter $systemChatParameter;

    public ?string $form_field_name;

    public ?string $role;

    public ?string $content;

    public function getTitle(): string|Htmlable
    {
        return __('Settings');
    }

    public function __construct()
    {
        $this->systemChatParameters = SystemChatParameter::all();
    }

    public function trigger($id)
    {
        $this->systemChatParameter = SystemChatParameter::find($id);
        $this->systemChatParameter->update([
            'form_field_name' => $this->form_field_name,
        ]);
    }

    public function save($id)
    {
        dump($id);
    }
}
