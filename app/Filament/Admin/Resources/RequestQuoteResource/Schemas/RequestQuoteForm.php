<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Schemas;

use App\Enums\ClientType;
use App\Models\WebsiteLanguage;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class RequestQuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)->columnSpanFull()->schema([
                    Section::make('Request Quote Details')->schema([
                        Grid::make(2)->schema([
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->preload()
                                ->searchable()
                                ->default(Auth::user()->id),
                            Toggle::make('is_payed')
                                ->label('Is Payed')
                                ->disabled()
                                ->default(false),
                            TextInput::make('quotation_name')
                                ->maxLength(255),
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->required()
                                ->email()
                                ->maxLength(255),
                            TextInput::make('phone')
                                ->required()
                                ->tel()
                                ->maxLength(255),
                            TextInput::make('discount')
                                ->default(0)
                                ->step(1000)
                                ->suffixIcon(Heroicon::Calculator)
                                ->required(),
                            RichEditor::make('project_description')
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Select::make('payment_method')
                                ->options([
                                    'stripe' => 'Stripe',
                                    'credit_card' => 'Credit Card',
                                    'paypal' => 'PayPal',
                                    'bank_transfer' => 'Bank Transfer',
                                ]),
                            Select::make('client_type')
                                ->required()
                                ->options(ClientType::class)
                                ->preload()
                                ->searchable(),
                            TextInput::make('company_name')
                                ->maxLength(255),
                            TextInput::make('company_address')
                                ->maxLength(255),
                            Select::make('website_type_id')
                                ->live()
                                ->required()
                                ->relationship('websiteType', 'name')
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                ])
                                ->afterStateUpdated(function (Set $set): void {
                                    $set('request_quote_functionalities', []);
                                })
                                ->searchable(),
                            Select::make('website_engine')
                                ->options([
                                    'laravel' => 'Laravel',
                                ])->required()
                                ->searchable(),
                        ]),
                    ]),
                    Section::make('Websites')->schema([
                        Repeater::make('websites')->schema([
                            TextInput::make('name'),
                            ToggleButtons::make('required')
                                ->live()
                                ->options([
                                    '1' => 'Yes',
                                    '0' => 'No',
                                ])
                                ->inline(),
                            ToggleButtons::make('length')
                                ->translateLabel()
                                ->live()
                                ->options([
                                    'short' => 'Short',
                                    'medium' => 'Medium',
                                    'large' => 'Large',
                                ])
                                ->inline(),
                            FileUpload::make('images')
                                ->label('Images')
                                ->disk('public')
                                ->directory('website-images')
                                ->openable()
                                ->downloadable()
                                ->multiple()
                                ->reorderable()
                                ->image()
                                ->maxFiles(10)
                                ->helperText(__('You can upload multiple images'))
                                ->columnSpanFull(),
                        ]),

                    ]),
                    Section::make('Website Graphic')->schema([
                        Toggle::make('have_website_graphic')
                            ->default(false)
                            ->label('Do you have a website graphic?')
                            ->disabled(),

                        CheckboxList::make('request_quote_functionalities')
                            ->relationship(name: 'requestQuoteFunctionalities',
                                modifyQueryUsing: fn (Get $get, Builder $query) => $query->where('website_type_id', $get('website_type_id')))
                            ->getOptionLabelFromRecordUsing(fn (Model $record): string => __($record->name))
                            ->columns(4),
                        Toggle::make('is_multilangual')
                            ->live(),
                        Select::make('default_language')
                            ->live()
                            ->visible(fn ($get) => $get('is_multilangual'))
                            ->default(WebsiteLanguage::whereName('Hungarian')->firstOrCreate(['name' => 'Hungarian'])->id)
                            ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                            ->preload()
                            ->afterStateUpdated(function (Set $set): void {
                                $set('languages', []);
                            })
                            ->searchable(),
                        Select::make('languages')
                            ->preload()
                            ->multiple()
                            ->visible(fn ($get) => $get('is_multilangual'))
                            ->options(function (Get $get) {
                                return WebsiteLanguage::query()->whereNot('id', '=', $get('default_language'))->pluck('name', 'id');
                            })
                            ->searchable(),
                    ]),
                ]),
            ]);
    }
}
