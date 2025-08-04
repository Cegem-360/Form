<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Enums\StripeCurrency;
use App\Enums\TransactionStatus;
use App\Filament\Admin\Resources\OrderResource\Pages\CreateOrder;
use App\Filament\Admin\Resources\OrderResource\Pages\EditOrder;
use App\Filament\Admin\Resources\OrderResource\Pages\ListOrders;
use App\Models\Order;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Orders';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('request_quote_id')
                    ->relationship('requestQuote', 'quotation_name')
                    ->preload()
                    ->label('Request quote name')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('currency')
                    ->options(StripeCurrency::class)
                    ->enum(StripeCurrency::class)
                    ->required(),
                Select::make('status')
                    ->label(__('Payment Status'))
                    ->options(TransactionStatus::class)
                    ->enum(TransactionStatus::class)
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state === TransactionStatus::COMPLETED && $record && $record->requestQuote) {
                            $record->requestQuote->update(['is_payed' => true]);
                        } else {
                            $record->requestQuote?->update(['is_payed' => false]);
                        }
                    })
                    ->translateLabel()
                    ->required(),
                TextInput::make('customer_email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('customer_name')
                    ->maxLength(255),
                Select::make('user_id')->required()
                    ->preload()
                    ->relationship('user', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('requestQuote.quotation_name')
                    ->label('Request quote name')
                    ->translateLabel()
                    ->searchable(),
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
                    ->label('Customer Email')
                    ->searchable(),
                TextColumn::make('customer_name')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
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
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
