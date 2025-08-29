<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;

final class DesignPagesSpecifications
{
    public static function make($visibility): Step
    {
        return Step::make('Design pages Specifications')->schema([
            FileUpload::make('own_company_images')
                ->visible($visibility?->own_company_images_visible)
                ->maxSize(2048)
                ->maxFiles(10)
                ->multiple()
                ->downloadable()
                ->disk('public')
                ->directory('own_company_images')
                ->visibility('public')
                ->preserveFilenames(),
            Toggle::make('use_video_or_animation')
                ->visible($visibility?->use_video_or_animation_visible),
            FileUpload::make('own_company_videos')
                ->visible($visibility?->own_company_videos_visible)
                ->maxSize(2048)
                ->multiple()
                ->downloadable()
                ->disk('public')
                ->directory('own_company_videos')
                ->visibility('public')
                ->preserveFilenames(),
            Section::make(__('Pages'))
                ->columnSpanFull()
                ->columns(1)
                ->schema([
                    Repeater::make('main_pages')
                        ->label(__('Pages'))
                        ->visible($visibility?->main_pages_visible)
                        ->defaultItems(3)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->schema([
                            TextInput::make('name')
                                ->maxLength(255)
                                ->required(),
                            RichEditor::make('description')
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('pages/attachments')
                                ->fileAttachmentsVisibility('public'),
                            FileUpload::make('images')
                                ->image()
                                ->downloadable()
                                ->reorderable()
                                ->multiple(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->addActionLabel(__('New Page')),
                ]),
            Section::make(__('Page Specifications'))
                ->columnSpanFull()
                ->columns(1)
                ->schema([
                    Toggle::make('have_product_catalog')
                        ->live()
                        ->visible($visibility?->have_product_catalog_visible),
                    FileUpload::make('product_catalog')
                        ->visible(fn (Get $get): bool => $visibility?->product_catalog_visible && $get('have_product_catalog'))
                        ->maxSize(2048)
                        ->multiple()
                        ->downloadable()
                        ->disk('public')
                        ->directory('product_catalog')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Toggle::make('need_multi_language')
                        ->live()
                        ->visible($visibility?->need_multi_language_visible),
                    TagsInput::make('languages_for_website')
                        ->label('Weboldal nyelvei')
                        ->placeholder('Új nyelv hozzáadása...')
                        ->suggestions([
                            'Magyar',
                            'Angol',
                            'Német',
                            'Francia',
                            'Spanyol',
                            'Olasz',
                            'Román',
                            'Szlovák',
                            'Horvát',
                            'Szerb',
                            'Ukrán',
                            'Orosz',
                            'Lengyel',
                            'Cseh',
                        ])
                        ->splitKeys(['Tab', ',', 'Enter'])
                        ->visible(fn (Get $get): bool => $visibility?->languages_for_website_visible && $get('need_multi_language')),
                    RichEditor::make('call_to_actions')
                        ->visible($visibility?->call_to_actions_visible),
                    Toggle::make('have_blog')
                        ->live()
                        ->visible($visibility?->have_blog_visible),
                    TextInput::make('exist_blog_count')
                        ->visible(fn (Get $get): bool => $visibility?->exist_blog_count_visible && $get('have_blog'))
                        ->numeric(),
                    Select::make('importance_of_seo')
                        ->visible($visibility?->importance_of_seo_visible)
                        ->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ]),
                    Toggle::make('have_payed_advertising')
                        ->visible($visibility?->have_payed_advertising_visible),
                    RichEditor::make('other_expectation_or_request')
                        ->visible($visibility?->other_expectation_or_request_visible)
                        ->columnSpanFull(),
                ]),
            Section::make('Kért funkciók')
                ->schema([
                    CheckboxList::make('project_functions')
                        ->label(__('Project Functions'))
                        ->options(function ($state, $component) {
                            $model = $component->getRecord();
                            if ($model && $model->projectQuoteFunctionalities()) {
                                return $model->projectQuoteFunctionalities()->pluck('name', 'id')->toArray();
                            }

                            return [];
                        })
                        ->disabled(),
                ]),

        ]);
    }
}
