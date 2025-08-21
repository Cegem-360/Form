<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages\Auth;

use App\Enums\ClientType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

final class EditProfile extends \Filament\Auth\Pages\EditProfile
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'company_name' => Auth::user()->company_name,
            'company_address' => Auth::user()->company_address,
            'company_vat_number' => Auth::user()->company_vat_number,
            'client_type' => Auth::user()->client_type,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                Select::make('client_type')
                    ->options(ClientType::class)
                    ->required()
                    ->live(debounce: 500)
                    ->enum(ClientType::class),
                TextInput::make('company_name')
                    ->required(fn ($get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn ($get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->live(debounce: 500),
                TextInput::make('company_address')
                    ->required(fn ($get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn ($get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->live(debounce: 500),
                TextInput::make('company_vat_number')
                    ->required(fn ($get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn ($get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(13)
                    ->unique(ignoreRecord: true)
                    ->live(debounce: 500)
                    ->rule('regex:/^\d{8}-\d{1}-\d{2}$/')
                    ->helperText('Formátum: 12345678-1-12'),

                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
