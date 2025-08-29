<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Enums\ClientType;
use App\Filament\Admin\Resources\UserResource\Pages\CreateUser;
use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Filament\Admin\Resources\UserResource\Pages\ListUsers;
use App\Filament\Admin\Resources\UserResource\Pages\ViewUser;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use UnitEnum;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Felhasználók';

    protected static ?string $modelLabel = 'Felhasználó';

    protected static ?int $navigationSort = 0;

    protected static ?string $pluralModelLabel = 'Felhasználók';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('default_commission_percent')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->label('Default Commission (%)')
                    ->required(),
                Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->label('Roles'),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->maxLength(20)
                    ->unique(ignoreRecord: true)
                    ->live(debounce: 500),
                Select::make('client_type')
                    ->options(ClientType::class)
                    ->searchable(false)
                    ->required()
                    ->live(debounce: 500)
                    ->enum(ClientType::class),
                TextInput::make('billing_address')
                    ->label('Billing Address')
                    ->live()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL),
                TextInput::make('company_name')
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->live(debounce: 500),
                TextInput::make('company_address')
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->live(debounce: 500),
                TextInput::make('company_vat_number')
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(13)
                    ->unique(ignoreRecord: true)
                    ->live(debounce: 500)
                    ->rule('regex:/^\d{8}-\d{1}-\d{2}$/')
                    ->helperText('Formátum: 12345678-1-12'),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),

        ];
    }
}
