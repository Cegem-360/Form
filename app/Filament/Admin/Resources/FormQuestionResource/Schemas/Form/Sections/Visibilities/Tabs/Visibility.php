<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\Visibilities\Tabs;

use App\Models\FormQuestion;
use App\Models\FormQuestionVisibility;
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;

final class Visibility
{
    public static $exceptions = [
        'products_csv_file_visible',
        'highlighted_categories_visible',
        'bruto_netto_visible',
        'store_address_visible',
        'shipping_address_visible',
        'parcel_points_visible',
        'have_contracted_accountant_visible',
        'contracted_accountants_visible',
        'payment_methods_visible',
        'have_contracted_online_bank_card_payment_visible',
        'online_bank_card_payment_options_visible',
    ];

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
                                    ->action(function (Set $set, ?FormQuestion $record): void {
                                        $fields = (new FormQuestionVisibility)->getFillable();
                                        $data = [];
                                        foreach ($fields as $field) {
                                            $set($field, true);
                                            $data[$field] = true;
                                        }

                                        if ($record instanceof FormQuestion) {
                                            $record->visibility()->updateOrCreate([], $data);
                                            Notification::make()
                                                ->title('Mentés sikeres')
                                                ->success()
                                                ->send();
                                        }
                                    }),
                                Action::make('website')
                                    ->label('All website fields to true')
                                    ->action(function (Set $set, ?FormQuestion $record): void {
                                        $fields = (new FormQuestionVisibility)->getFillable();
                                        $data = [];
                                        foreach ($fields as $field) {
                                            if (in_array($field, self::$exceptions, true)) {
                                                continue;
                                            }

                                            $set($field, true);
                                            $data[$field] = true;
                                        }

                                        if ($record instanceof FormQuestion) {
                                            $record->visibility()->updateOrCreate([], $data);
                                            Notification::make()
                                                ->title('Mentés sikeres')
                                                ->success()
                                                ->send();
                                        }
                                    }),
                                Action::make('all_set_false')
                                    ->label('All set to false')
                                    ->action(function (Set $set, ?FormQuestion $record): void {
                                        $fields = (new FormQuestionVisibility)->getFillable();
                                        $data = [];
                                        foreach ($fields as $field) {
                                            $set($field, false);
                                            $data[$field] = false;
                                        }

                                        if ($record instanceof FormQuestion) {
                                            $record->visibility()->updateOrCreate([], $data);
                                            Notification::make()
                                                ->title('Mentés sikeres')
                                                ->success()
                                                ->send();
                                        }
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
