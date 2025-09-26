<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Schemas;

use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\Components\Repeaters\Website;
use App\Models\WebsiteType;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\Storage;

final class WebsiteInformation
{
    public static function make(): Step
    {
        return
                Step::make('Website Informations')->schema([
                    Repeater::make('websites')
                        ->live()
                        ->deletable(function (Get $get) {
                            $websiteTypeId = $get('website_type_id');

                            if (! $websiteTypeId) {
                                return true;
                            }

                            $websiteType = WebsiteType::find($websiteTypeId);
                            if (! $websiteType) {
                                return true;
                            }

                            return $websiteType->name !== 'Landing Page';
                        })
                        ->addActionLabel(__('Filament/pages/request-quote.repeter_webpage_add_test'))
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->minItems(1)
                        ->maxItems(30)
                        ->collapsible()
                        ->defaultItems(10)
                        ->schema([
                            Grid::make(2)->columnSpan(1)->schema([
                                Section::make()->schema(
                                    Website::make(),
                                ),
                                Section::make()
                                    ->components([
                                        Text::make(__('short_description'))
                                            ->weight(FontWeight::Bold),
                                        Image::make(url: Storage::url(path: 'website_previews/short_preview.webp'), alt: __('Rövid méretű előnézet'))
                                            ->alignCenter()
                                            ->imageSize('22rem'),
                                    ])
                                    ->visible(fn (Get $get): bool => $get('required') && $get('length') === 'short'),
                                Section::make()
                                    ->components([
                                        Text::make(__('medium_description'))
                                            ->weight(FontWeight::Bold),
                                        Image::make(
                                            url: Storage::url(path: 'website_previews/medium_preview.webp'),
                                            alt: __('Közepes méretű előnézet'))
                                            ->alignCenter()
                                            ->imageSize('22rem'),
                                    ])
                                    ->visible(fn (Get $get): bool => $get('required') && $get('length') === 'medium'),
                                Section::make()
                                    ->components([
                                        Text::make(__('large_description'))
                                            ->weight(FontWeight::Bold),
                                        Image::make(
                                            url: Storage::url(path: 'website_previews/large_preview.webp'),
                                            alt: __('Nagy méretű előnézet'))
                                            ->alignCenter()
                                            ->imageSize('22rem'),
                                    ])
                                    ->visible(fn (Get $get): bool => $get('required') && $get('length') === 'large'),
                            ]),
                        ]),
                ]);
    }
}
