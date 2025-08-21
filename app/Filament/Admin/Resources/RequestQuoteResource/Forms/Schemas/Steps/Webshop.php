<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard\Step;

final class Webshop
{
    public static function make($visibility): Step
    {
        $stepVisible = (
            $visibility?->products_csv_file_visible
            || $visibility?->highlighted_categories_visible
            || $visibility?->bruto_netto_visible
            || $visibility?->store_address_visible
            || $visibility?->shipping_address_visible
            || $visibility?->parcel_points_visible
            || $visibility?->have_contracted_accountant_visible
            || $visibility?->contracted_accountants_visible
            || $visibility?->payment_methods_visible
            || $visibility?->have_contracted_online_bank_card_payment_visible
            || $visibility?->online_bank_card_payment_options_visible
        );

        return Step::make('Webshop')->visible($stepVisible)->schema([
            FileUpload::make('products_csv_file')
                ->visible($visibility?->products_csv_file_visible)
                ->maxSize(2048)
                ->maxFiles(1)
                ->downloadable()
                ->disk('public')
                ->directory('products_csv_file')
                ->visibility('public')
                ->preserveFilenames(),
            Repeater::make('highlighted_categories')
                ->visible($visibility?->highlighted_categories_visible)
                ->defaultItems(3)
                ->collapsible()
                ->collapsed()
                ->reorderableWithDragAndDrop()
                ->schema([
                    TextInput::make('name')
                        ->maxLength(255)
                        ->required(),
                    RichEditor::make('description')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('categories/attachments')
                        ->fileAttachmentsVisibility('public'),
                ])
                ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
            Select::make('bruto_netto')
                ->visible($visibility?->bruto_netto_visible)
                ->options([
                    'bruto' => 'bruto',
                    'netto' => 'netto',
                ]),
            TextInput::make('store_address')
                ->visible($visibility?->store_address_visible)
                ->maxLength(255),
            TextInput::make('shipping_address')
                ->visible($visibility?->shipping_address_visible)
                ->maxLength(255),
            Select::make('parcel_points')
                ->visible($visibility?->parcel_points_visible)
                ->options([
                    'gls' => 'GLS',
                    'dpd' => 'DPD',
                    'dhl' => 'DHL',
                    'mpl' => 'MPL',
                ])->multiple(),
            Toggle::make('have_contracted_accountant')
                ->visible($visibility?->have_contracted_accountant_visible),
            Repeater::make('contracted_accountants')
                ->visible($visibility?->contracted_accountants_visible)
                ->defaultItems(1)
                ->collapsible()
                ->collapsed()
                ->reorderableWithDragAndDrop()
                ->schema([
                    TextInput::make('name')
                        ->maxLength(255)
                        ->required(),
                ])
                ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
            Select::make('payment_methods')
                ->visible($visibility?->payment_methods_visible)
                ->multiple()
                ->options([
                    'cash' => 'cash',
                    'credit_card' => 'credit card',
                    'bank_transfer' => 'bank transfer',
                    'paypal' => 'PayPal',
                ]),
            Toggle::make('have_contracted_online_bank_card_payment')
                ->visible($visibility?->have_contracted_online_bank_card_payment_visible),
            Repeater::make('online_bank_card_payment_options')
                ->visible($visibility?->online_bank_card_payment_options_visible)
                ->defaultItems(1)
                ->collapsible()
                ->collapsed()
                ->reorderableWithDragAndDrop()
                ->schema([
                    TextInput::make('name')
                        ->maxLength(255)
                        ->required(),
                ])
                ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
        ]);
    }
}
