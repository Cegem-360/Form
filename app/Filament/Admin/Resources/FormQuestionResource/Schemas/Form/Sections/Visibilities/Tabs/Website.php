<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\Visibilities\Tabs;

use App\Enums\FormQuestionStatus;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;

final class Website
{
    public static function make(): Tab
    {
        return Tab::make('website')->schema([
            Section::make('Company basic informations')
                ->schema([
                    Select::make('domain_id') // hidden
                        ->relationship('domain', 'name')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required(),
                            TextInput::make('url')
                                ->url()
                                ->required(),
                            TextInput::make('description')
                                ->required(),
                        ])
                        ->searchable()
                        ->preload(),
                    Select::make('status')
                        ->options(FormQuestionStatus::class)
                        ->default(FormQuestionStatus::UNFILLED)
                        ->required()
                        ->enum(FormQuestionStatus::class),
                    TextInput::make('token'),
                    TextInput::make('company_name') // 1. page
                        ->maxLength(255),
                    TextInput::make('contact_name') // 1. page
                        ->maxLength(255),
                    TextInput::make('contact_email') // 1. page
                        ->email()
                        ->maxLength(255),
                    TextInput::make('contact_phone') // 1. page
                        ->tel()
                        ->maxLength(255),
                    FileUpload::make('logo') // 1. page
                        ->image()
                        ->maxSize(2048)
                        ->maxFiles(1)
                        ->downloadable(),
                    Repeater::make('activities')// serveces etc. 1. page
                        ->defaultItems(3)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->schema([
                            TextInput::make('name')
                                ->maxLength(255)
                                ->required(),
                        ]),
                ])
                ->description('The Company basic informations')
                ->collapsible()
                ->collapsed(),
            Section::make('Theme') // 2. page
                ->schema([
                    Toggle::make('have_exist_website') // 2. page
                        ->required(),
                    TextInput::make('exist_website_url') // 2. page
                        ->url(),
                    Toggle::make('is_exact_deadline')
                        ->required(),
                    DatePicker::make('deadline'),
                    MarkdownEditor::make('formating_milestone')->label('Kiemelt értékeink')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('attachments')
                        ->fileAttachmentsVisibility('public'),
                    MarkdownEditor::make('visual_feeling')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('attachments')
                        ->fileAttachmentsVisibility('public'),
                    TextInput::make('tone_of_website')
                        ->maxLength(255),
                    Toggle::make('have_exist_design')
                        ->required(),
                    FileUpload::make('design_files')
                        ->downloadable()
                        ->multiple()
                        ->disk('public')
                        ->directory('design_files')
                        ->visibility('public'),

                    Repeater::make('banned_elements')
                        ->defaultItems(3)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->schema([
                            Textarea::make('element')
                                ->columnSpanFull()
                                ->required(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['element'] ?? null),
                    ColorPicker::make('primary_color'),
                    ColorPicker::make('secondary_color'),
                    Repeater::make('additional_colors')
                        ->defaultItems(3)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->schema([
                            ColorPicker::make('color')
                                ->required(),
                            TextInput::make('description'),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['description'] ?? null),
                    Repeater::make('prefered_font_types')
                        ->schema([
                            TextInput::make('font_type_name')
                                ->required(),
                        ])
                        ->defaultItems(3)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->itemLabel(fn (array $state): ?string => $state['font_type_name'] ?? null),
                ])
                ->collapsible()
                ->collapsed(),
            Section::make('Design pages Specifications')
                ->schema([
                    FileUpload::make('own_company_images')
                        ->image()
                        ->maxSize(2048)
                        ->maxFiles(10)
                        ->multiple()
                        ->downloadable()
                        ->disk('public')
                        ->directory('own_company_images')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Toggle::make('use_video_or_animation'),
                    FileUpload::make('own_company_videos')
                        ->maxSize(2048)
                        ->multiple()
                        ->downloadable()
                        ->disk('public')
                        ->directory('own_company_videos')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Repeater::make('main_pages')
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
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->addActionLabel(__('New Page')),

                    Toggle::make('have_product_catalog')
                        ->required(),
                    FileUpload::make('product_catalog')
                        ->maxSize(2048)
                        ->multiple()
                        ->downloadable()
                        ->disk('public')
                        ->directory('product_catalog')
                        ->visibility('public')
                        ->preserveFilenames(),

                    Toggle::make('need_multi_language'),
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
                        ->splitKeys(['Tab', ',', 'Enter']),
                    RichEditor::make('call_to_actions'),
                    Toggle::make('have_blog')
                        ->required(),
                    TextInput::make('exist_blog_count')
                        ->numeric(),
                    Select::make('importance_of_seo')
                        ->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ]),
                    Toggle::make('have_payed_advertising'),
                    RichEditor::make('other_expectation_or_request')
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed(),

            Section::make('Webshop')
                ->collapsible()
                ->collapsed()
                ->schema([
                    FileUpload::make('products_csv_file')
                        ->image()
                        ->maxSize(2048)
                        ->maxFiles(1)
                        ->downloadable()
                        ->disk('public')
                        ->directory('products_csv_file')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Repeater::make('highlighted_categories')
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
                                ->fileAttachmentsDirectory('categories/attachments')
                                ->fileAttachmentsVisibility('public'),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    Select::make('bruto_netto')
                        ->label('Brutó vagy netto megjelenés és behúzás')
                        ->options([
                            'bruto-bruto' => 'Brutó megjelnités és import',
                            'bruto-netto' => 'Brutó megjelenés és  nettó import',
                            'netto-bruto' => 'Netto megjelenés és brutó import',
                            'netto-netto' => 'Netto megjelenés és nettó import',
                        ]),
                    TextInput::make('store_address')
                        ->maxLength(255),
                    TextInput::make('shipping_address')
                        ->maxLength(255),
                    Select::make('parcel_points')
                        ->options([
                            'gls' => 'GLS',
                            'dpd' => 'DPD',
                            'dhl' => 'DHL',
                            'mpl' => 'MPL',
                        ])->multiple(),
                    Toggle::make('have_contracted_accountant'),
                    Repeater::make('contracted_accountants')
                        ->defaultItems(1)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->schema([
                            TextInput::make('name')
                                ->maxLength(255)
                                ->required(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    Select::make('payment_methods')
                        ->options([
                            'cash' => 'cash',
                            'credit_card' => 'credit card',
                            'bank_transfer' => 'bank transfer',
                            'paypal' => 'PayPal',
                        ])->multiple(),
                    Toggle::make('have_contracted_online_bank_card_payment'),
                    Repeater::make('online_bank_card_payment_options')
                        ->defaultItems(1)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->schema([
                            TextInput::make('name')
                                ->maxLength(255)
                                ->required(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                ])
                ->collapsible()
                ->collapsed(),

        ]);
    }
}
