<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Schemas;

use App\Models\WebsiteType;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard\Step;

final class ClientInformation
{
    public static function make(): Step
    {
        return Step::make('Client Informations')
            ->schema([
                Grid::make(1)->schema([
                    Html::make(null)
                        ->view('filament.forms.components.welcome'),
                    Grid::make(2)->gridContainer()->schema([
                        Select::make('website_type_id')
                            ->live()
                            ->required()
                            ->searchable(false)
                            ->options(function () {
                                return WebsiteType::all()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                                    return [$id => __($name)];
                                });
                            })

                            ->afterStateUpdated(function (Set $set, $state): void {
                                $set('request_quote_functionalities', []);
                                if (WebsiteType::query()->find($state)->name === 'Webshop') {
                                    $set('websites', self::webshop());
                                } elseif (WebsiteType::query()->find($state)->name === 'Weboldal') {
                                    $set('websites', self::website());
                                } elseif (WebsiteType::query()->find($state)->name === 'Landing Page') {
                                    $set('websites', self::landingPage());
                                } else {
                                    $set('websites', []);
                                }
                            })
                            ->hintAction(
                                Action::make('help')
                                    ->icon('heroicon-o-question-mark-circle')
                                    ->extraAttributes(['class' => 'text-gray-500'])
                                    ->label('')
                                    ->tooltip(function (): string|array|null {
                                        return __('Filament/pages/request-quote.website_type_tooltip');
                                    })
                            ),
                        Select::make('website_engine')
                            ->live()
                            ->hintAction(
                                Action::make('help')
                                    ->icon('heroicon-o-question-mark-circle')
                                    ->extraAttributes(['class' => 'text-gray-500'])
                                    ->label('')
                                    ->tooltip(function ($state): string|array|null {
                                        return match ($state) {
                                            'laravel' => __('Filament/pages/request-quote.website_engine_laravel_tooltip'),
                                            default => __('Filament/pages/request-quote.website_engine_tooltip'),
                                        };
                                    })
                            )
                            ->searchable(false)
                            ->options([
                                'laravel' => 'Laravel',
                            ])->required(),

                    ]),
                ]),
            ]);
    }

    public static function website(): array
    {
        return [
            [
                'name' => __('Főoldal'),
                'length' => 'medium',
                'required' => '1',
            ],
            [
                'name' => __('Kapcsolat'),
                'length' => 'medium',
                'required' => '1',
            ],
            [
                'name' => __('Termékeink'),
                'length' => 'medium',
                'required' => '0',
            ],
            [
                'name' => __('Rólunk'),
                'length' => 'medium',
                'required' => '0',
            ],
            [
                'name' => __('Szolgáltatások'),
                'length' => 'medium',
                'required' => '0',
            ],
            [
                'name' => __('Blog'),
                'length' => 'medium',
                'required' => '0',
            ],
            [
                'name' => __('Gyakori kérdések'),
                'length' => 'medium',
                'required' => '0',
            ],
        ];
    }

    public static function webshop(): array
    {
        return [
            [
                'name' => __('Főoldal'),
                'length' => 'medium',
                'required' => '1',
            ],
            [
                'name' => __('Webshop'),
                'length' => 'medium',
                'required' => '1',
            ],
            [
                'name' => __('Rólunk'),
                'length' => 'medium',
                'required' => '0',
            ],
            [
                'name' => __('Szolgáltatások'),
                'length' => 'medium',
                'required' => '0',
            ],
            [
                'name' => __('Blog'),
                'length' => 'medium',
                'required' => '0',
            ],
            [
                'name' => __('Gyakori kérdések'),
                'length' => 'medium',
                'required' => '0',
            ],
        ];
    }

    public static function landingPage(): array
    {
        return [
            [
                'name' => __('Főoldal'),
                'length' => 'medium',
                'required' => '1',
            ],
        ];
    }
}
