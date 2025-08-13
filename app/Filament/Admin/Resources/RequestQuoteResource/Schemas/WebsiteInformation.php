<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Schemas;

use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\Components\Repeaters\Website;
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
                    Grid::make(1)->schema([
                        Repeater::make('websites')->schema([
                            Grid::make(2)->columnSpan(1)->schema([
                                Grid::make(2)->columnSpan(1)
                                    ->schema(Website::make()),
                                Grid::make(1)->columnSpan(1)->schema([
                                    Section::make()
                                        ->components(
                                            components: [
                                                Text::make(' Ideális választás a lényegre törő, gyorsan áttekinthető aloldalakhoz, mint például egy szolgáltatás rövid bemutatása vagy egy kapcsolati oldal. Maximum 2 szakaszt tartalmaz, melyekben 1-1 szövegdoboz és 1-1 kép helyezhető el.')
                                                    ->weight(FontWeight::Bold),
                                                Image::make(
                                                    url: Storage::url(path: 'website_previews/short_preview.png'),
                                                    alt: 'Rövid méretű előnézet')
                                                    ->alignCenter()
                                                    ->imageSize('22rem'),
                                            ]
                                        )
                                        ->visible(function (Get $get) {
                                            return $get('required') && $get('length') === 'short' ? true : false;
                                        }),
                                    Section::make()
                                        ->components([
                                            Text::make('Ez az opció lehetőséget biztosít részletesebb információk megjelenítésére, elegendő térrel egy termék vagy szolgáltatás komplexebb leírásához. Tartalmazhat maximum 5 képet, 5 szövegdobozt és 2 bannert, biztosítva az optimális egyensúlyt a szöveg és a vizuális elemek között.')
                                                ->weight(FontWeight::Bold),
                                            Image::make(
                                                url: Storage::url(path: 'website_previews/medium_preview.png'),
                                                alt: 'Közepes méretű előnézet')
                                                ->alignCenter()
                                                ->imageSize('22rem'),
                                        ])
                                        ->visible(function (Get $get) {
                                            return $get('required') && $get('length') === 'medium' ? true : false;
                                        }),
                                    Section::make()
                                        ->components([
                                            Text::make('A legátfogóbb választás, tökéletes részletes termékoldalakhoz, szolgáltatásbemutatókhoz, amelyek alapos tájékoztatást nyújtanak. Akár 10 kép és 10 szövegdoboz, 5 banner, valamint olyan elemek, mint „előnyeink” szekció, egyedi kép-szöveg kompozíciók, visszaszámláló, "rólunk mondták" idézetek, értékelések, valamint termék- és szolgáltatáskategóriák behúzása is beilleszthető.')
                                                ->weight(FontWeight::Bold),
                                            Image::make(
                                                url: Storage::url(path: 'website_previews/large_preview.png'),
                                                alt: 'Nagy méretű előnézet')
                                                ->alignCenter()
                                                ->imageSize('22rem'),
                                        ])
                                        ->visible(function (Get $get) {
                                            return $get('required') && $get('length') === 'large' ? true : false;
                                        }),
                                ]),
                            ]),
                        ])
                            ->deletable(false)
                            ->addActionLabel(__('Filament/pages/request-quote.repeter_webpage_add_test'))
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->minItems(1)
                            ->maxItems(30)
                            ->collapsible()
                            ->defaultItems(10),
                    ]),
                ]);
    }
}
