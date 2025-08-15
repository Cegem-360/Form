<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Enums\ClientType;
use App\Filament\Admin\Resources\RequestQuoteResource\Pages\CreateRequestQuote;
use App\Filament\Admin\Resources\RequestQuoteResource\Pages\EditRequestQuote;
use App\Filament\Admin\Resources\RequestQuoteResource\Pages\ListRequestQuotes;
use App\Filament\Admin\Resources\RequestQuoteResource\Pages\ViewRequestQuote;
use App\Models\RequestQuote;
use App\Models\WebsiteLanguage;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

final class RequestQuoteResource extends Resource
{
    protected static ?string $model = RequestQuote::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Árajánlat';

    protected static ?string $navigationLabel = 'Árajánlatok';

    protected static ?string $modelLabel = 'Árajánlat';

    protected static ?int $navigationSort = 0;

    protected static ?string $pluralModelLabel = 'Árajánlatok';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    RichEditor::make('project_description')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                    Select::make('payment_method')
                        ->options([
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
                            'wordpress' => 'Wordpress',
                            'laravel' => 'Laravel',
                            'shopify' => 'Shopify',
                        ])->required()
                        ->searchable(),
                ]),
                Grid::make(1)->schema([
                    Repeater::make('websites')->schema([
                        Grid::make(2)->columnSpan(1)->schema([
                            Grid::make(1)->columnSpan(1)->schema([
                                TextInput::make('name')->required(),
                                ToggleButtons::make('required')
                                    ->live()
                                    ->options([
                                        '1' => 'Yes',
                                        '0' => 'No',
                                    ])
                                    ->inline()
                                    ->required(),
                                ToggleButtons::make('length')
                                    ->live()
                                    ->options([
                                        'short' => 'Short',
                                        'medium' => 'Medium',
                                        'large' => 'Large',
                                    ])
                                    ->inline()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                        $set('image', match ($state) {
                                            'short' => 'website_previews/short_preview.png',
                                            'medium' => 'website_previews/medium_preview.png',
                                            'large' => 'website_previews/large_preview.png',
                                            default => null,
                                        });
                                    })
                                    ->required(fn ($get) => $get('required')),
                                RichEditor::make('description')
                                    ->maxLength(65535),
                                FileUpload::make('images')

                                    ->label('Image')
                                    ->visible(fn ($get) => $get('required'))
                                    ->disk('public')
                                    ->directory('website-images')
                                    ->openable()
                                    ->downloadable()
                                    ->reorderable()
                                    ->maxFiles(10)
                                    ->acceptedFileTypes(['jpg', 'jpeg', 'png', 'gif'])
                                    ->helperText(__('You can upload multiple images'))
                                    ->columnSpanFull(),

                            ]),

                        ]),

                    ]),

                ]),
                Grid::make(1)->schema([
                    Toggle::make('have_website_graphic')
                        ->default(false)
                        ->label('Do you have a website graphic?')
                        ->disabled(),
                ]),
                CheckboxList::make('request_quote_functionalities')
                    ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                        return $query->where('website_type_id', $get('website_type_id'));
                    })
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => __($record->name)),
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
                   /*  ->relationship('languages', 'name') */
                    ->preload()

                    ->multiple()
                    ->visible(fn ($get) => $get('is_multilangual'))
                    ->options(function (Get $get) {
                        return WebsiteLanguage::whereNot('id', '=', $get('default_language'))->pluck('name', 'id');
                    })
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('quotation_name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('website_type_id.name')
                    ->label('Website Type')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_multilangual')
                    ->boolean(),
                ToggleColumn::make('is_payed')
                    ->label('Is Payed'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRequestQuotes::route('/'),
            'create' => CreateRequestQuote::route('/create'),
            'view' => ViewRequestQuote::route('/{record}'),
            'edit' => EditRequestQuote::route('/{record}/edit'),
        ];
    }
}
