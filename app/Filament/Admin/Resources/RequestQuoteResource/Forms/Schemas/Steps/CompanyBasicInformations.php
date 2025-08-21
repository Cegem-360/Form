<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard\Step;

final class CompanyBasicInformations
{
    public static function make($visibility): Step
    {
        return Step::make('Company basic informations')
            ->columns(3)
            ->schema([
                TextInput::make('company_name')
                    ->visible($visibility?->company_name_visible)
                    ->columnSpan(1)
                    ->maxLength(255),
                TextInput::make('contact_name')
                    ->visible($visibility?->contact_name_visible)
                    ->columnSpan(1)
                    ->maxLength(255),
                TextInput::make('contact_email')
                    ->visible($visibility?->contact_email_visible)
                    ->columnSpan(1)
                    ->email()
                    ->maxLength(255),
                TextInput::make('contact_phone')
                    ->visible($visibility?->contact_phone_visible)
                    ->tel()
                    ->maxLength(255),
                Textarea::make('activities')
                    ->visible($visibility?->activities_visible)
                    ->columnSpan(1),
                FileUpload::make('logo')
                    ->columnSpanFull()
                    ->visible($visibility?->logo_visible)
                    ->image()
                    ->maxSize(2048)
                    ->maxFiles(1)
                    ->downloadable(),

            ])
            ->description(__('The Company basic informations'));
    }
}
