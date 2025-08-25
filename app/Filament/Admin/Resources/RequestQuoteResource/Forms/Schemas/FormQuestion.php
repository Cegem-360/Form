<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas;

use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps\CompanyBasicInformations;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps\DesignPagesSpecifications;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps\Theme;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps\Webshop;
use App\Models\FormQuestionVisibility;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

final class FormQuestion
{
    public static function configure(Schema $schema, FormQuestionVisibility $visibility): Schema
    {
        return $schema->components([
            Wizard::make([
                CompanyBasicInformations::make($visibility),
                Theme::make($visibility),
                DesignPagesSpecifications::make($visibility),
                Webshop::make($visibility),
                Step::make('Véglegesítés')->schema([
                    Checkbox::make('consent')
                        ->live()
                        ->label('I agree to the terms and conditions(note:later has link)')
                        ->default(false)
                        ->helperText(__('You must agree to the terms and conditions to proceed.'))
                        ->required()
                        ->accepted(true),
                    Checkbox::make('privacy_policy')
                        ->live()
                        ->label('I agree to the processing of my personal data in accordance with the privacy policy(note:later has link)')
                        ->default(false)
                        ->helperText(__('You must agree to the processing of your personal data in accordance with the privacy policy to proceed.'))
                        ->required()
                        ->accepted(true),
                    Checkbox::make('consent_start')
                        ->live()
                        ->label('I acknowledge that work can begin')
                        ->default(false)
                        ->helperText(__('You must acknowledge that work can begin to proceed.'))
                        ->required()
                        ->accepted(true),
                ]), ])
                ->skippable(),
        ]);
    }
}
