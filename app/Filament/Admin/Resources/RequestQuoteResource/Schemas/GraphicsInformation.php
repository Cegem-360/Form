<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Schemas;

use App\Models\RequestQuoteFunctionality;
use App\Models\WebsiteLanguage;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

final class GraphicsInformation
{
    public static function make(): Step
    {
        return Step::make('Grafics and functions')->schema([
            Grid::make(2)->schema([
                TextInput::make('quotation_name')
                    ->columnSpan(1)
                    ->maxLength(255)
                    ->required(),
                Section::make()->columnSpanFull()->components([
                    Text::make('Kérjük, írja le részletesen weboldal-projektjét, maximum 20 000 karakter terjedelemben. Itt lehetősége van megosztani velünk elképzeléseit a weboldal céljával, célközönségével, kívánt hangulatával, preferált színeivel vagy stílusával kapcsolatban, valamint bármilyen egyéb, releváns információt, amely segíthet a projekt megértésében. A weboldal specifikus funkcióit, valamint a nyelvesítési igényeket kérjük, az oldal alján található külön beállítási lehetőségeknél adja meg.'),
                ]),
                Toggle::make('have_website_graphic')
                    ->columnSpanFull()
                    ->default(false)
                    ->label('Do you have a website graphic?')
                    ->hidden(true)
                    ->disabled(),
                Section::make()
                    ->heading('Rendelkezik már kész grafikai tervvel vagy látványtervvel (UI) a weboldalához?')
                    ->components([
                        Text::make(Html::make('<h3 class="text-lg font-medium"> Mi is az a grafikai terv / látványterv (UI)? </h3>')),
                        Html::make(null)
                            ->content(
                                '<p> A grafikai terv vagy látványterv (User Interface – UI) a weboldal vizuális megjelenését, elrendezését és felhasználói
                        felületét mutatja be még a fejlesztés megkezdése előtt. Ez magában foglalja a színsémákat, tipográfiát, képek és
                        szövegek elrendezését, gombok megjelenését, valamint minden olyan vizuális összetevőt,
                        amely meghatározza a felhasználói élményt, így egyfajta „digitális tervrajzot” biztosítva a weboldalhoz.</p>'),

                    ]),
                ToggleButtons::make('have_website_graphic')
                    ->label('Do you have a website graphic?')
                    ->live()
                    ->default(false)
                    ->inline()
                    ->boolean()
                    ->required(),
            ]),
            CheckboxList::make('requestQuoteFunctionalities')
                ->searchable(false)
                ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                    return $query->whereWebsiteTypeId($get('website_type_id'))?->notDefault();
                })
                ->getOptionLabelFromRecordUsing(fn (Model $record): string => sprintf('%s', $record->name))
                ->disabled(fn ($get): bool => $get('website_type_id') === null)
                ->descriptions(function (Get $get) {
                    return RequestQuoteFunctionality::whereWebsiteTypeId($get('website_type_id'))
                        ->notDefault()
                        ->get()
                        ->mapWithKeys(function ($functionality): array {
                            return [
                                $functionality->id => new HtmlString($functionality->description),
                            ];
                        })
                        ->toArray();
                }),
            Toggle::make('is_multilangual')
                ->live(),
            Select::make('default_language')
                ->live()
                ->visible(fn ($get) => $get('is_multilangual'))
                ->default(WebsiteLanguage::whereName('Magyar')->firstOrCreate(['name' => 'Magyar'])->id)
                ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                ->preload()
                ->afterStateUpdated(function (Set $set): void {
                    $set('languages', []);
                })
                ->searchable(),
            Select::make('languages')
                ->multiple()
                ->visible(fn ($get) => $get('is_multilangual'))
                ->options(function (Get $get) {
                    return WebsiteLanguage::query()->whereNot('id', '=', $get('default_language'))->pluck('name', 'id');
                })
                ->searchable(),
        ]);
    }
}
