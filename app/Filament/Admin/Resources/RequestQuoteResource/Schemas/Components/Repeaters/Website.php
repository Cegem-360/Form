<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Schemas\Components\Repeaters;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Utilities\Set;

final class Website
{
    public static function make(): array
    {
        return [
            TextInput::make('name')
                ->disabled(fn ($get): bool => $get('name') === 'Főoldal' || $get('name') === 'Webshop')
                ->live()
                ->required()
                ->distinct(),
            ToggleButtons::make('required')
                ->disabled(fn ($get): bool => $get('name') === 'Főoldal' || $get('name') === 'Webshop')
                ->label('Want to this page?')
                ->live()
                ->grouped()

                ->default('0')
                ->boolean()
                ->colors([
                    'true' => 'success',
                    'false' => 'danger',
                ])
                ->inline()
                ->required(),
            ToggleButtons::make('length')
                ->label('Content length')
                ->live()
                ->visible(fn ($get) => $get('required'))
                ->default('medium')
                ->required(fn ($get) => $get('required'))
                ->options([
                    'short' => __('Short'),
                    'medium' => __('Medium'),
                    'large' => __('Large'),
                ])
                ->inline()
                ->afterStateUpdated(function ($state, Set $set): void {
                    $set('image', $state);
                })
                ->required()
                ->columnSpanFull(),
            /*  RichEditor::make('description')
                ->default('<p></p>')
                ->disableToolbarButtons(['attachFiles'])
                ->visible(fn ($get) => $get('required'))
                ->label(__('Page description'))
                ->maxLength(65535)
                ->columnSpanFull(), */
            FileUpload::make('images')
                ->label('Adott oldalhoz esetleges igényelt képek feltöltése')
                ->visible(fn ($get) => $get('required'))
                ->image()
                ->multiple()
                ->disk('public')
                ->directory('website-images')
                ->openable()
                ->downloadable()
                ->reorderable()
                ->maxFiles(10)
                ->helperText(__('You can upload multiple images'))
                ->columnSpanFull(),
        ];
    }
}
