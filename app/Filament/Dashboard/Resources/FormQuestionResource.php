<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\FormQuestionResource\Pages\ListFormQuestions;
use App\Filament\Dashboard\Resources\FormQuestionResource\Pages\ViewFormQuestion;
use App\Models\FormQuestion;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

final class FormQuestionResource extends Resource
{
    protected static ?string $model = FormQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): string
    {
        return __('Projects');
    }

    public static function getNavigationLabel(): string
    {
        return __('Form Questions');
    }

    public static function getPluralLabel(): string
    {
        return __('Form Questions');
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
                    ->numeric()
                    ->sortable(),
                TextColumn::make('project.requestQuote.quotation_name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormQuestions::route('/'),
            'view' => ViewFormQuestion::route('/{record}'),

        ];
    }
}
