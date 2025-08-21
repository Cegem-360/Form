<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\TransactionStatus;
use App\Filament\Dashboard\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Dashboard\Resources\OrderResource\Pages\ViewOrder;
use App\Models\Order;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

final class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('request_quote_id')
                    ->relationship('requestQuote', 'quotation_name')
                    ->label('Request quote name')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('currency')
                    ->required()
                    ->maxLength(3),
                TextInput::make('customer_email')
                    ->email()
                    ->maxLength(255),
                Select::make('status')
                    ->label(__('Payment Status'))
                    ->options(TransactionStatus::class)
                    ->enum(TransactionStatus::class)
                    ->required(),

                TextInput::make('customer_name')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                return $query->whereUserId(Auth::user()->id);
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('requestQuote.quotation_name')
                    ->label(__('Request quote'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->formatStateUsing(fn (int $state): string => Number::currency($state, 'HUF', 'hu', 0))
                    ->sortable(),
                TextColumn::make('currency')
                    ->searchable(),
                TextColumn::make('customer_email')
                    ->searchable(),
                TextColumn::make('customer_name')
                    ->searchable(),
                TextColumn::make('status')
                    ->label(__('Payment Status'))
                    ->badge()
                    ->color(fn (TransactionStatus $state): string => match ($state) {
                        TransactionStatus::PENDING => 'gray',
                        TransactionStatus::COMPLETED => 'success',
                        TransactionStatus::FAILED => 'danger',
                        TransactionStatus::REFUNDED => 'warning',
                        default => 'gray',
                    }),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'view' => ViewOrder::route('/{record}'),
        ];
    }
}
