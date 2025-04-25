<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\FormQuestionResource\Pages\ListFormQuestions;
use App\Filament\Resources\FormQuestionResource\Pages\CreateFormQuestion;
use App\Filament\Resources\FormQuestionResource\Pages\EditFormQuestion;
use App\Enums\ProjectStatus;
use App\Enums\UserRole;
use App\Filament\Resources\FormQuestionResource\Pages;
use App\Models\FormQuestion;
use Filament\Forms\Components\Actions\Action;
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
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction;

class FormQuestionResource extends Resource
{
    protected static ?string $model = FormQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Project';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('ProjectUser')->columns(2)->schema([
                    Select::make('project_id')
                        ->relationship('project', 'name')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required(),
                            ToggleButtons::make('status')
                                ->options(ProjectStatus::class)->required(),
                        ])
                        ->searchable()
                        ->preload()
                        ->columns(2),
                    Select::make('user_id')
                        ->relationship('user', 'name'),
                ])->visible(Auth::user()->hasRole([UserRole::SUPER_ADMIN, UserRole::ADMIN])),

                Split::make([
                    Section::make('website')->schema([
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
                                TextInput::make('token') // hidden
                                    ->hintAction(
                                        CopyAction::make('copyTokenUrl')
                                            ->label('Copy URL for questions form')
                                            ->icon('heroicon-o-clipboard')
                                            ->copyable(function (Set $set, $state) {
                                                $token = Str::random(60);
                                                if ($state == null) {
                                                    $set('token', $token);
                                                }

                                                if ($state != null) {
                                                    $token = $state;
                                                }

                                                return route('kerdoiv', ['token' => $token]);
                                            })

                                    ),
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
                                TextInput::make('contact_position')// 1. page
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
                                Textarea::make('other_tone_of_website')
                                    ->columnSpanFull(),
                                Toggle::make('have_exist_design')
                                    ->required(),
                                FileUpload::make('design_files')
                                    ->downloadable()
                                    ->multiple()
                                    ->disk('public')
                                    ->directory('design_files')
                                    ->visibility('public'),
                                Repeater::make('inspire_websites')
                                    ->defaultItems(10)
                                    ->collapsible()
                                    ->collapsed()
                                    ->reorderableWithDragAndDrop()
                                    ->schema([
                                        TextInput::make('url')
                                            ->url()
                                            ->required(),
                                        RichEditor::make('description')
                                            ->required(),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['url'] ?? null),
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
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                                Textarea::make('other_pages')
                                    ->columnSpanFull(),
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
                                Textarea::make('languages_for_website')
                                    ->maxLength(255),
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
                                    ->options([
                                        'bruto' => 'bruto',
                                        'netto' => 'netto',
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

                    ]),
                    Section::make('Visibilty')
                        ->id('visibility')
                        ->relationship('visibility')
                        ->schema([
                            Section::make('basic website info')
                                ->id('basic_website_info')
                                ->headerActions([
                                    Action::make('all_set_true')
                                        ->label('All set to true')
                                        ->action(function (Set $set): void {
                                            $set('company_name_visible', true);
                                            $set('company_name_visible', true);
                                            $set('contact_name_visible', true);
                                            $set('contact_email_visible', true);
                                            $set('contact_phone_visible', true);
                                            $set('contact_position_visible', true);
                                            $set('logo_visible', true);
                                            $set('activities_visible', true);
                                        }),
                                ])
                                ->collapsible()
                                ->collapsed()
                                ->schema([
                                    Toggle::make('company_name_visible')->live(),
                                    Toggle::make('contact_name_visible')->live(),
                                    Toggle::make('contact_email_visible')->live(),
                                    Toggle::make('contact_phone_visible')->live(),
                                    Toggle::make('contact_position_visible')->live(),
                                    Toggle::make('logo_visible')->live(),
                                    Toggle::make('activities_visible')->live(),
                                ]),
                            Section::make('Theme')
                                ->headerActions([
                                    Action::make('all_set_true')
                                        ->label('All set to true')
                                        ->action(function (Set $set): void {

                                            $set('have_exist_website_visible', true);
                                            $set('exist_website_url_visible', true);
                                            $set('is_exact_deadline_visible', true);
                                            $set('deadline_visible', true);
                                            $set('formating_milestone_visible', true);
                                            $set('visual_feeling_visible', true);
                                            $set('tone_of_website_visible', true);
                                            $set('other_tone_of_website_visible', true);
                                            $set('have_exist_design_visible', true);
                                            $set('design_files_visible', true);
                                            $set('inspire_websites_visible', true);
                                            $set('banned_elements_visible', true);
                                            $set('primary_color_visible', true);
                                            $set('secondary_color_visible', true);
                                            $set('additional_colors_visible', true);
                                            $set('prefered_font_types_visible', true);

                                        }),
                                ])
                                ->collapsible()
                                ->collapsed()
                                ->schema([
                                    Toggle::make('have_exist_website_visible')->live(),
                                    Toggle::make('exist_website_url_visible')->live(),
                                    Toggle::make('is_exact_deadline_visible')->live(),
                                    Toggle::make('deadline_visible')->live(),
                                    Toggle::make('formating_milestone_visible')->live(),
                                    Toggle::make('visual_feeling_visible')->live(),
                                    Toggle::make('tone_of_website_visible')->live(),
                                    Toggle::make('other_tone_of_website_visible')->live(),
                                    Toggle::make('have_exist_design_visible')->live(),
                                    Toggle::make('design_files_visible')->live(),
                                    Toggle::make('inspire_websites_visible')->live(),
                                    Toggle::make('banned_elements_visible')->live(),
                                    Toggle::make('primary_color_visible')->live(),
                                    Toggle::make('secondary_color_visible')->live(),
                                    Toggle::make('additional_colors_visible')->live(),
                                    Toggle::make('prefered_font_types_visible')->live(),
                                ]),
                            Section::make('Design Specifications')
                                ->headerActions([
                                    Action::make('all_set_true')
                                        ->label('All set to true')
                                        ->action(function (Set $set): void {

                                            $set('own_company_images_visible', true);
                                            $set('use_video_or_animation_visible', true);
                                            $set('own_company_videos_visible', true);
                                            $set('main_pages_visible', true);
                                            $set('other_pages_visible', true);
                                            $set('have_product_catalog_visible', true);
                                            $set('product_catalog_visible', true);
                                            $set('need_multi_language_visible', true);
                                            $set('languages_for_website_visible', true);
                                            $set('call_to_actions_visible', true);
                                            $set('have_blog_visible', true);
                                            $set('exist_blog_count_visible', true);
                                            $set('importance_of_seo_visible', true);
                                            $set('have_payed_advertising_visible', true);
                                            $set('other_expectation_or_request_visible', true);

                                        }),
                                ])
                                ->collapsible()
                                ->collapsed()
                                ->schema([
                                    Toggle::make('own_company_images_visible')->live(),
                                    Toggle::make('use_video_or_animation_visible')->live(),
                                    Toggle::make('own_company_videos_visible')->live(),
                                    Toggle::make('main_pages_visible')->live(),
                                    Toggle::make('other_pages_visible')->live(),
                                    Toggle::make('have_product_catalog_visible')->live(),
                                    Toggle::make('product_catalog_visible')->live(),
                                    Toggle::make('need_multi_language_visible')->live(),
                                    Toggle::make('languages_for_website_visible')->live(),
                                    Toggle::make('call_to_actions_visible')->live(),
                                    Toggle::make('have_blog_visible')->live(),
                                    Toggle::make('exist_blog_count_visible')->live(),
                                    Toggle::make('importance_of_seo_visible')->live(),
                                    Toggle::make('have_payed_advertising_visible')->live(),
                                    Toggle::make('other_expectation_or_request_visible')->live(),
                                ]),
                            Section::make('Webshop')
                                ->headerActions([
                                    Action::make('all_set_true')
                                        ->label('All set to true')
                                        ->action(function (Set $set): void {
                                            $set('products_csv_file_visible', true);
                                            $set('highlighted_categories_visible', true);
                                            $set('bruto_netto_visible', true);
                                            $set('store_address_visible', true);
                                            $set('shipping_address_visible', true);
                                            $set('parcel_points_visible', true);
                                            $set('have_contracted_accountant_visible', true);
                                            $set('contracted_accountants_visible', true);
                                            $set('payment_methods_visible', true);
                                            $set('have_contracted_online_bank_card_payment_visible', true);
                                            $set('online_bank_card_payment_options_visible', true);

                                        }),
                                ])
                                ->schema([
                                    Toggle::make('products_csv_file_visible')->live(),
                                    Toggle::make('highlighted_categories_visible')->live(),
                                    Toggle::make('bruto_netto_visible')->live(),
                                    Toggle::make('store_address_visible')->live(),
                                    Toggle::make('shipping_address_visible')->live(),
                                    Toggle::make('parcel_points_visible')->live(),
                                    Toggle::make('have_contracted_accountant_visible')->live(),
                                    Toggle::make('contracted_accountants_visible')->live(),
                                    Toggle::make('payment_methods_visible')->live(),
                                    Toggle::make('have_contracted_online_bank_card_payment_visible')->live(),
                                    Toggle::make('online_bank_card_payment_options_visible')->live(),
                                ])
                                ->collapsible()
                                ->collapsed(),

                        ])->grow(false),
                ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('domain.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('contact_name')
                    ->searchable(),
                TextColumn::make('contact_email')
                    ->searchable(),
                TextColumn::make('contact_phone')
                    ->searchable(),

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
                EditAction::make(),

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
            'create' => CreateFormQuestion::route('/create'),
            'edit' => EditFormQuestion::route('/{record}/edit'),
        ];
    }
}
