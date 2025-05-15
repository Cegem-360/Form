<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BasePage;
use Illuminate\Support\Facades\Auth;

final class EditProfile extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            Auth::user()->name,
            Auth::user()->email,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('username')
                    ->required()
                    ->maxLength(255),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
