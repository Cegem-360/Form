<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages\ListProjectCommissions;
use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages\ViewProjectCommission;
use App\Models\ProjectCommission;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ProjectCommissionResource extends Resource
{
    protected static ?string $model = ProjectCommission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): string
    {
        return __('Project Commission');
    }

    public static function getPluralLabel(): string
    {
        return __('Project Commissions');
    }

    public static function getNavigationLabel(): string
    {
        return __('Project Commissions');
    }

    public static function getNavigationGroup(): string
    {
        return __('Project Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->translateLabel()
                    ->relationship('project', 'name'),
                TextInput::make('commission_amount')
                    ->translateLabel()
                    ->numeric(),
                TextInput::make('commission_percent')
                    ->translateLabel()
                    ->numeric(),
                TextInput::make('commission_paid_amount')
                    ->translateLabel()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->translateLabel()
                    ->sortable(),
                TextColumn::make('commission_amount')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_percent')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_paid_amount')
                    ->translateLabel()
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
            'index' => ListProjectCommissions::route('/'),
            'view' => ViewProjectCommission::route('/{record}'),
        ];
    }
}
