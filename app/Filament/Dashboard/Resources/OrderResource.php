<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\RolesEnum;
use App\Filament\Dashboard\Resources\OrderResource\Pages\CreateOrder;
use App\Filament\Dashboard\Resources\OrderResource\Pages\EditOrder;
use App\Filament\Dashboard\Resources\OrderResource\Pages\ListOrders;
use App\Models\Order;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

final class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): string
    {
        return __('Orders');
    }

    public static function getLabel(): string
    {
        return __('Orders');
    }

    public static function getPluralLabel(): string
    {
        return __('Orders');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('request_quote_id')
                    ->translateLabel()
                    ->relationship('requestQuote', 'name')
                    ->label('Request quote')
                    ->required(),
                TextInput::make('amount')
                    ->translateLabel()
                    ->required()
                    ->numeric(),
                TextInput::make('currency')
                    ->translateLabel()
                    ->required()
                    ->maxLength(3),
                TextInput::make('status')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('customer_email')
                    ->translateLabel()
                    ->email()
                    ->maxLength(255),
                TextInput::make('customer_name')
                    ->translateLabel()
                    ->maxLength(255),
                Select::make('user_id')
                    ->visible(fn (): bool => Auth::user()->hasRole([RolesEnum::SUPER_ADMIN, RolesEnum::ADMIN]))
                    ->relationship('user', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('amount')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('currency')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('status')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('customer_email')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('customer_name')
                    ->translateLabel()
                    ->searchable(),
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
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
