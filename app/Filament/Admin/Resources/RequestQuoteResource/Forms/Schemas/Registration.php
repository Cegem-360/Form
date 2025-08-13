<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas;

use App\Enums\ClientType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;

final class Registration
{
    public static function make(): array
    {
        return [
            Select::make('client_type')
                ->label('Legal form')
                ->live()
                ->required()
                ->options(ClientType::class)
                ->enum(ClientType::class),
            TextInput::make('company_name')
                ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                ->maxLength(255),
            TextInput::make('company_address')
                ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                ->maxLength(255),
            TextInput::make('name')
                ->label('Full Name')
                ->live()
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->unique('users', 'email')
                ->live()
                ->required()
                ->maxLength(255),
            TextInput::make('phone')
                ->tel()
                ->live()
                ->required()
                ->maxLength(255),
            TextInput::make('password')
                ->confirmed()
                ->password()
                ->revealable()
                ->required()
                ->maxLength(255),
            TextInput::make('password_confirmation')
                ->password()
                ->revealable()
                ->required(),
        ];
    }
}
