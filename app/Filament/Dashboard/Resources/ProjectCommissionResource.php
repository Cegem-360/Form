<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages\ListProjectCommissions;
use App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages\ViewProjectCommission;
use App\Models\ProjectCommission;
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

final class ProjectCommissionResource extends Resource
{
    protected static ?string $model = ProjectCommission::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

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
        return __('Projects');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')

                    ->relationship('project', 'name'),
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
            ->modifyQueryUsing(function ($query) {
                return $query->whereUserId(Auth::user()->id);
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('project.name')

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
