<?php

namespace App\Filament\Dashboard\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages\ListProjectCommissions;
use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages\CreateProjectCommission;
use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages\EditProjectCommission;
use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages;
use App\Filament\Dashboard\Resources\ProjectCommissionResource\RelationManagers;
use App\Models\ProjectCommission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectCommissionResource extends Resource
{
    protected static ?string $model = ProjectCommission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->relationship('project', 'name'),
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('commission_amount')
                    ->numeric(),
                TextInput::make('commission_percent')
                    ->numeric(),
                TextInput::make('commission_paid_amount')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_percent')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_paid_amount')
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
            'create' => CreateProjectCommission::route('/create'),
            'edit' => EditProjectCommission::route('/{record}/edit'),
        ];
    }
}
