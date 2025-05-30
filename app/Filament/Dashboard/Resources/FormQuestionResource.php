<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\ProjectStatus;
use App\Filament\Dashboard\Resources\FormQuestionResource\Pages\ListFormQuestions;
use App\Filament\Dashboard\Resources\FormQuestionResource\Pages\ViewFormQuestion;
use App\Models\FormQuestion;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction;

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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('ProjectUser')->translateLabel()->columns(2)->schema([
                    Select::make('project_id')
                        ->translateLabel()
                        ->relationship('project', 'name')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->translateLabel()
                                ->required(),
                            ToggleButtons::make('status')
                                ->translateLabel()
                                ->options(ProjectStatus::class)->required(),
                        ])
                        ->searchable()
                        ->preload()
                        ->columns(2),

                ]),
                Split::make([
                    Section::make(__('website'))->translateLabel()->schema([
                        Section::make(__('Company basic informations'))
                            ->translateLabel()
                            ->schema([
                                Select::make('domain_id') // hidden
                                    ->translateLabel()
                                    ->relationship('domain', 'name')
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->translateLabel()
                                            ->required(),
                                        TextInput::make('url')
                                            ->translateLabel()
                                            ->url()
                                            ->required(),
                                        TextInput::make('description')
                                            ->translateLabel()
                                            ->required(),
                                    ])
                                    ->searchable()
                                    ->preload(),
                                TextInput::make('token') // hidden
                                    ->translateLabel()
                                    ->hintAction(
                                        CopyAction::make('copyTokenUrl')
                                            ->label('Copy URL for questions form')
                                            ->icon('heroicon-o-clipboard')
                                            ->copyable(function (Set $set, $state) {
                                                $token = Str::random(60);
                                                if ($state === null) {
                                                    $set('token', $token);
                                                }

                                                if ($state !== null) {
                                                    $token = $state;
                                                }

                                                return route('kerdoiv', ['token' => $token]);
                                            })

                                    ),
                                TextInput::make('company_name') // 1. page
                                    ->translateLabel()
                                    ->maxLength(255),
                                TextInput::make('contact_name') // 1. page
                                    ->translateLabel()
                                    ->maxLength(255),
                                TextInput::make('contact_email') // 1. page
                                    ->translateLabel()
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('contact_phone') // 1. page
                                    ->translateLabel()
                                    ->tel()
                                    ->maxLength(255),
                                TextInput::make('contact_position')// 1. page
                                    ->translateLabel()
                                    ->maxLength(255),
                                FileUpload::make('logo') // 1. page
                                    ->translateLabel()
                                    ->image()
                                    ->maxSize(2048)
                                    ->maxFiles(1)
                                    ->downloadable(),
                                Repeater::make('activities')// serveces etc. 1. page
                                    ->translateLabel()
                                    ->defaultItems(3)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        TextInput::make('name')
                                            ->translateLabel()
                                            ->maxLength(255)
                                            ->required(),
                                    ]),
                            ])
                            ->description('The Company basic informations')
                            ->collapsible()
                            ->collapsed(),
                        Section::make('Theme') // 2. page
                            ->translateLabel()
                            ->schema([
                                Toggle::make('have_exist_website') // 2. page
                                    ->translateLabel()
                                    ->required(),
                                TextInput::make('exist_website_url') // 2. page
                                    ->translateLabel()
                                    ->url(),
                                Toggle::make('is_exact_deadline')
                                    ->translateLabel()
                                    ->required(),
                                DatePicker::make('deadline')
                                    ->translateLabel(),
                                MarkdownEditor::make('formating_milestone')->label('Kiemelt értékeink')
                                    ->translateLabel()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('attachments')
                                    ->fileAttachmentsVisibility('public'),
                                MarkdownEditor::make('visual_feeling')
                                    ->translateLabel()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('attachments')
                                    ->fileAttachmentsVisibility('public'),
                                TextInput::make('tone_of_website')
                                    ->translateLabel()
                                    ->maxLength(255),
                                Textarea::make('other_tone_of_website')
                                    ->translateLabel()
                                    ->columnSpanFull(),
                                Toggle::make('have_exist_design')
                                    ->translateLabel()
                                    ->required(),
                                FileUpload::make('design_files')
                                    ->translateLabel()
                                    ->downloadable()
                                    ->multiple()
                                    ->disk('public')
                                    ->directory('design_files')
                                    ->visibility('public'),
                                Repeater::make('inspire_websites')
                                    ->translateLabel()
                                    ->defaultItems(10)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        TextInput::make('url')
                                            ->translateLabel()
                                            ->url()
                                            ->required(),
                                        RichEditor::make('description')
                                            ->translateLabel()
                                            ->required(),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['url'] ?? null),
                                Repeater::make('banned_elements')
                                    ->translateLabel()
                                    ->defaultItems(3)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        Textarea::make('element')
                                            ->translateLabel()
                                            ->columnSpanFull()
                                            ->required(),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['element'] ?? null),
                                ColorPicker::make('primary_color')
                                    ->translateLabel(),
                                ColorPicker::make('secondary_color')
                                    ->translateLabel(),
                                Repeater::make('additional_colors')
                                    ->translateLabel()
                                    ->defaultItems(3)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        ColorPicker::make('color')
                                            ->translateLabel()
                                            ->required(),
                                        TextInput::make('description')
                                            ->translateLabel(),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['description'] ?? null),
                                Repeater::make('prefered_font_types')
                                    ->translateLabel()
                                    ->schema([
                                        TextInput::make('font_type_name')
                                            ->translateLabel()
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
                                    ->translateLabel()
                                    ->defaultItems(3)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        TextInput::make('name')
                                            ->translateLabel()
                                            ->maxLength(255)
                                            ->required(),
                                        RichEditor::make('description')
                                            ->translateLabel()
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('pages/attachments')
                                            ->fileAttachmentsVisibility('public'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                                Textarea::make('other_pages')
                                    ->translateLabel()
                                    ->columnSpanFull(),
                                Toggle::make('have_product_catalog')
                                    ->translateLabel()
                                    ->required(),
                                FileUpload::make('product_catalog')
                                    ->translateLabel()
                                    ->maxSize(2048)
                                    ->multiple()
                                    ->downloadable()
                                    ->disk('public')
                                    ->directory('product_catalog')
                                    ->visibility('public')
                                    ->preserveFilenames(),

                                Toggle::make('need_multi_language')
                                    ->translateLabel(),
                                Textarea::make('languages_for_website')
                                    ->translateLabel()
                                    ->maxLength(255),
                                RichEditor::make('call_to_actions')
                                    ->translateLabel(),
                                Toggle::make('have_blog')
                                    ->translateLabel()
                                    ->required(),
                                TextInput::make('exist_blog_count')
                                    ->translateLabel()
                                    ->numeric(),
                                Select::make('importance_of_seo')
                                    ->translateLabel()
                                    ->options([
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                        '5' => '5',
                                    ]),
                                Toggle::make('have_payed_advertising')
                                    ->translateLabel(),
                                RichEditor::make('other_expectation_or_request')
                                    ->translateLabel()
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->collapsed(),

                        Section::make('Webshop')
                            ->translateLabel()
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                                FileUpload::make('products_csv_file')
                                    ->translateLabel()
                                    ->image()
                                    ->maxSize(2048)
                                    ->maxFiles(1)
                                    ->downloadable()
                                    ->disk('public')
                                    ->directory('products_csv_file')
                                    ->visibility('public')
                                    ->preserveFilenames(),
                                Repeater::make('highlighted_categories')
                                    ->translateLabel()
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
                                    ->translateLabel()
                                    ->options([
                                        'bruto' => 'bruto',
                                        'netto' => 'netto',
                                    ]),
                                TextInput::make('store_address')
                                    ->translateLabel()
                                    ->maxLength(255),
                                TextInput::make('shipping_address')
                                    ->translateLabel()
                                    ->maxLength(255),
                                Select::make('parcel_points')
                                    ->translateLabel()
                                    ->options([
                                        'gls' => 'GLS',
                                        'dpd' => 'DPD',
                                        'dhl' => 'DHL',
                                        'mpl' => 'MPL',
                                    ])->multiple(),
                                Toggle::make('have_contracted_accountant')
                                    ->translateLabel(),
                                Repeater::make('contracted_accountants')
                                    ->translateLabel()
                                    ->defaultItems(1)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        TextInput::make('name')
                                            ->translateLabel()
                                            ->maxLength(255)
                                            ->required(),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                                Select::make('payment_methods')
                                    ->translateLabel()
                                    ->options([
                                        'cash' => 'cash',
                                        'credit_card' => 'credit card',
                                        'bank_transfer' => 'bank transfer',
                                        'paypal' => 'PayPal',
                                    ])->multiple(),
                                Toggle::make('have_contracted_online_bank_card_payment')
                                    ->translateLabel(),
                                Repeater::make('online_bank_card_payment_options')
                                    ->translateLabel()
                                    ->defaultItems(1)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        TextInput::make('name')
                                            ->translateLabel()
                                            ->maxLength(255)
                                            ->required(),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                            ])
                            ->collapsible()
                            ->collapsed(),

                    ]),

                ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
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
