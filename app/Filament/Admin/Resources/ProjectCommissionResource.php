<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectCommissionResource\Pages;
use App\Filament\Admin\Resources\ProjectCommissionResource\RelationManagers;
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
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\TextInput::make('commission_amount')
                    ->numeric(),
                Forms\Components\TextInput::make('commission_percent')
                    ->numeric(),
                Forms\Components\TextInput::make('commission_paid_amount')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commission_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commission_percent')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commission_paid_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProjectCommissions::route('/'),
            'create' => Pages\CreateProjectCommission::route('/create'),
            'edit' => Pages\EditProjectCommission::route('/{record}/edit'),
        ];
    }
}
