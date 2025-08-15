<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\Visibilities\Tabs;

use App\Models\FormQuestionVisibility;
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;

final class Visibility
{
    public static function make(): Tab
    {
        return Tab::make('Visibility')
            ->schema([
                Section::make('visibility')->id('visibility')
                    ->relationship('visibility')
                    ->schema([

                        Section::make('All field')
                            ->id('all_field')
                            ->headerActions([
                                Action::make('all_set_true')
                                    ->label('All set to true')
                                    ->action(function (Set $set): void {
                                        array_map(fn (string $field): mixed => $set($field, true), (new FormQuestionVisibility)->getFillable());
                                    }),
                            ])
                            ->collapsible()
                            ->collapsed()
                            ->schema(
                                array_map(fn (string $field): Toggle => Toggle::make($field)->live(), (new FormQuestionVisibility)->getFillable()),
                            ),

                    ]),
            ]);
    }
}
