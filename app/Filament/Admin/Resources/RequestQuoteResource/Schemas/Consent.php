<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Schemas;

use App\Enums\ClientType;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

final class Consent
{
    public static function make(): Step
    {
        return Step::make('Consent')->schema([Grid::make(1)
            ->schema([
                TextInput::make('name')
                    ->label('Full Name')
                    ->live()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn (): bool => ! Auth::check()),
                TextInput::make('email')
                    ->email()
                    ->live()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn (): bool => ! Auth::check()),
                TextInput::make('phone')
                    ->tel()
                    ->live()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn (): bool => ! Auth::check()),
                Select::make('client_type')
                    ->label('Legal form')
                    ->live()
                    ->required()
                    ->options(ClientType::class)
                    ->preload()
                    ->visible(fn (): bool => ! Auth::check()),
                TextInput::make('company_name')
                    ->visible(fn (Get $get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->visible(fn (Get $get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_contact_name')
                    ->visible(fn (Get $get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                Checkbox::make('consent')
                    ->live()
                    ->default(false)
                    ->label(fn (): Htmlable => new HtmlString(
                        __('I agree to the terms and conditions').' <a href="https://cegem360.hu/altalanos-szerzodesi-feltetelek-cegem360/" target="_blank">Link</a>'
                    ))
                    ->required()
                    ->helperText(__('You must agree to the terms and conditions to proceed.'))
                    ->rules(['accepted']),
                Checkbox::make('privacy_policy')
                    ->live()
                    ->label(fn (): Htmlable => new HtmlString(
                        __('I agree to the processing of my personal data in accordance with the privacy policy').' <a href="https://cegem360.hu/adatvedelmi-tajekoztato/" target="_blank">Link</a>'
                    ))
                    ->default(false)
                    ->helperText(__('You must agree to the processing of your personal data in accordance with the privacy policy to proceed.'))
                    ->required()
                    ->rules(['accepted']),
            ]),
        ]);
    }
}
