<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\ContactChannelResource\Pages\ListContactChannels;
use App\Filament\Resources\ContactChannelResource\Pages\CreateContactChannel;
use App\Filament\Resources\ContactChannelResource\Pages\ViewContactChannel;
use App\Filament\Resources\ContactChannelResource\Pages\EditContactChannel;
use App\Filament\Resources\ContactChannelResource\Pages;
use App\Models\ContactChannel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactChannelResource extends Resource
{
    protected static ?string $model = ContactChannel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
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
                ViewAction::make(),
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
            'index' => ListContactChannels::route('/'),
            'create' => CreateContactChannel::route('/create'),
            'view' => ViewContactChannel::route('/{record}'),
            'edit' => EditContactChannel::route('/{record}/edit'),
        ];
    }
}
