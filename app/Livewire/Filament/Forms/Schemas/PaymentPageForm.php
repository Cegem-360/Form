<?php

declare(strict_types=1);

namespace App\Livewire\Filament\Forms\Schemas;

use App\Enums\ClientType;
use App\Models\RequestQuote;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

final class PaymentPageForm
{
    public static function configure(Schema $schema, ?RequestQuote $requestQuote): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->live()
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->live()
                    ->email(),
                TextInput::make('phone')
                    ->label('Phone')
                    ->live()
                    ->required(),
                Select::make('client_type')
                    ->enum(ClientType::class)
                    ->label('Legal form')
                    ->live()
                    ->required()
                    ->options(ClientType::class),
                TextInput::make('billing_address')
                    ->label('Billing Address')
                    ->live()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL),
                TextInput::make('company_name')
                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255),
                TextInput::make('company_vat_number')
                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255),
                Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'stripe' => 'Stripe',
                        'bank_transfer' => __('Bank Transfer'),
                    ])
                    ->default('stripe')
                    ->afterStateUpdated(fn ($state): int => $requestQuote->update(['payment_method' => $state]))
                    ->required()
                    ->live(),
                Checkbox::make('terms')
                    ->label(__('I have read and accept the terms and conditions'))
                    ->required()
                    ->accepted()
                    ->default(false)
                    ->live(),
                Checkbox::make('privacy')
                    ->label(__('I have read and accept the privacy policy'))
                    ->required()
                    ->accepted()
                    ->default(false)
                    ->live(),
            ])
            ->statePath('data')
            ->model(RequestQuote::class);
    }
}
