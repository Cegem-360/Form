<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\FormQuestionResource\Pages\ListFormQuestions;
use App\Filament\Dashboard\Resources\FormQuestionResource\Pages\ViewFormQuestion;
use App\Models\FormQuestion;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

final class FormQuestionResource extends Resource
{
    protected static ?string $model = FormQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

    /* public static function form(Form $form): Form
    {
        return $form;
    } */

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                return $query->whereUserId(Auth::user()->id);
            })
            ->columns([
                TextColumn::make('project.name')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('project.requestQuote.quotation_name')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->translateLabel()
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
                ViewAction::make(),

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
            'index' => ListFormQuestions::route('/'),
            'view' => ViewFormQuestion::route('/{record}'),

        ];
    }
}
