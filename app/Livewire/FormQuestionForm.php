<?php

declare(strict_types=1);

namespace App\Livewire;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use App\Enums\FormQuestionStatus;
use App\Models\FormQuestion;
use Filament\Actions\Action as SubmitButton;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class FormQuestionForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public ?FormQuestion $post;

    public ?string $token;

    public function mount(?string $token = null): void
    {
        $this->token = $token;
        $this->post = FormQuestion::whereToken($this->token)->first();
        if (! $this->post instanceof FormQuestion) {
            $this->redirect(route('form.expired'));
        }

        $this->form->fill($this->post->toArray());

    }

    public function form(Schema $schema): Schema
    {
        $visibility = $this->post->visibility()->first();

        return $schema->components([
            Wizard::make([
                Step::make('Company basic informations')
                    ->translateLabel()
                    ->columns(3)
                    ->schema([
                        TextInput::make('company_name')
                            ->translateLabel()
                            ->visible($visibility->company_name_visible)
                            ->columnSpan(1)
                            ->maxLength(255),
                        TextInput::make('contact_name')
                            ->translateLabel()
                            ->visible($visibility->contact_name_visible)
                            ->columnSpan(1)
                            ->maxLength(255),
                        TextInput::make('contact_email')
                            ->translateLabel()
                            ->visible($visibility->contact_email_visible)
                            ->columnSpan(1)
                            ->email()
                            ->maxLength(255),
                        TextInput::make('contact_phone')
                            ->translateLabel()
                            ->visible($visibility->contact_phone_visible)
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('contact_position')
                            ->translateLabel()
                            ->visible($visibility->contact_position_visible)
                            ->maxLength(255),
                        Textarea::make('activities')
                            ->translateLabel()
                            ->visible($visibility->activities_visible)
                            ->columnSpan(1),
                        FileUpload::make('logo')
                            ->translateLabel()
                            ->columnSpanFull()
                            ->visible($visibility->logo_visible)
                            ->image()
                            ->maxSize(2048)
                            ->maxFiles(1)
                            ->downloadable(),

                    ])
                    ->description(__('The Company basic informations')),
                Step::make('Theme')
                    ->translateLabel()
                    ->columns(3)
                    ->schema([
                        Toggle::make('have_exist_website')
                            ->translateLabel()
                            ->columnSpan(1)
                            ->live()
                            ->inline()
                            ->visible($visibility->have_exist_website_visible),
                        Toggle::make('is_exact_deadline')
                            ->translateLabel()
                            ->columnSpan(2)
                            ->live()
                            ->visible($visibility->is_exact_deadline_visible),
                        TextInput::make('exist_website_url')
                            ->translateLabel()
                            ->visible(fn (Get $get): bool => $visibility->exist_website_url_visible && $get('have_exist_website'))
                            ->url(),

                        DatePicker::make('deadline')
                            ->translateLabel()
                            ->visible(fn (Get $get): bool => $visibility->deadline_visible && $get('is_exact_deadline')),
                        MarkdownEditor::make('formating_milestone')
                            ->translateLabel()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->visible($visibility->formating_milestone_visible),
                        MarkdownEditor::make('visual_feeling')
                            ->translateLabel()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->visible($visibility->visual_feeling_visible),
                        TextInput::make('tone_of_website')
                            ->translateLabel()
                            ->visible($visibility->tone_of_website_visible)
                            ->maxLength(255),
                        Textarea::make('other_tone_of_website')
                            ->translateLabel()
                            ->columnSpanFull()
                            ->visible($visibility->other_tone_of_website_visible),
                        Toggle::make('have_exist_design')
                            ->translateLabel()
                            ->columnSpanFull()
                            ->live()
                            ->visible($visibility->have_exist_design_visible),
                        FileUpload::make('design_files')
                            ->translateLabel()
                            ->columnSpanFull()
                            ->visible(fn (Get $get): bool => $visibility->design_files_visible && $get('have_exist_design'))
                            ->downloadable()
                            ->multiple()
                            ->disk('public')
                            ->directory('design_files')
                            ->visibility('public'),
                        Repeater::make('inspire_websites')
                            ->translateLabel()
                            ->columnSpanFull()
                            ->visible($visibility->inspire_websites_visible)
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
                            ->columnSpanFull()
                            ->visible($visibility->banned_elements_visible)
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
                        Section::make(__('Colors and Fonts'))->columns(2)
                            ->compact()
                            ->schema([
                                ColorPicker::make('primary_color')
                                    ->translateLabel()
                                    ->visible($visibility->primary_color_visible),
                                ColorPicker::make('secondary_color')
                                    ->translateLabel()
                                    ->visible($visibility->secondary_color_visible),
                                Repeater::make('additional_colors')
                                    ->translateLabel()
                                    ->columnSpanFull()
                                    ->visible($visibility->additional_colors_visible)
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
                            ]),
                        Repeater::make('prefered_font_types')
                            ->translateLabel()
                            ->visible($visibility->prefered_font_types_visible)
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
                    ]),

                Step::make('Design pages Specifications')->translateLabel()->schema([
                    FileUpload::make('own_company_images')
                        ->translateLabel()
                        ->visible($visibility->own_company_images_visible)
                        ->maxSize(2048)
                        ->maxFiles(10)
                        ->multiple()
                        ->downloadable()
                        ->disk('public')
                        ->directory('own_company_images')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Toggle::make('use_video_or_animation')
                        ->translateLabel()
                        ->visible($visibility->use_video_or_animation_visible),
                    FileUpload::make('own_company_videos')
                        ->translateLabel()
                        ->visible($visibility->own_company_videos_visible)
                        ->maxSize(2048)
                        ->multiple()
                        ->downloadable()
                        ->disk('public')
                        ->directory('own_company_videos')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Repeater::make('main_pages')
                        ->translateLabel()
                        ->visible($visibility->main_pages_visible)
                        ->defaultItems(3)
                        ->collapsible()
                        ->collapsed()
                        ->reorderableWithDragAndDrop()
                        ->schema([TextInput::make('name')
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
                        ->visible($visibility->other_pages_visible)
                        ->columnSpanFull(),
                    Toggle::make('have_product_catalog')
                        ->translateLabel()
                        ->live()
                        ->visible($visibility->have_product_catalog_visible),
                    FileUpload::make('product_catalog')
                        ->translateLabel()
                        ->visible(fn (Get $get): bool => $visibility->product_catalog_visible && $get('have_product_catalog'))
                        ->maxSize(2048)
                        ->multiple()
                        ->downloadable()
                        ->disk('public')
                        ->directory('product_catalog')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Toggle::make('need_multi_language')
                        ->translateLabel()
                        ->live()
                        ->visible($visibility->need_multi_language_visible),
                    Textarea::make('languages_for_website')
                        ->translateLabel()
                        ->visible(fn (Get $get): bool => $visibility->languages_for_website_visible && $get('need_multi_language'))
                        ->maxLength(255),
                    RichEditor::make('call_to_actions')
                        ->translateLabel()
                        ->visible($visibility->call_to_actions_visible),
                    Toggle::make('have_blog')
                        ->translateLabel()
                        ->live()
                        ->visible($visibility->have_blog_visible),
                    TextInput::make('exist_blog_count')
                        ->translateLabel()
                        ->visible(fn (Get $get): bool => $visibility->exist_blog_count_visible && $get('have_blog'))
                        ->numeric(),
                    Select::make('importance_of_seo')
                        ->translateLabel()
                        ->visible($visibility->importance_of_seo_visible)
                        ->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ]),
                    Toggle::make('have_payed_advertising')
                        ->translateLabel()
                        ->visible($visibility->have_payed_advertising_visible),
                    RichEditor::make('other_expectation_or_request')
                        ->translateLabel()
                        ->visible($visibility->other_expectation_or_request_visible)
                        ->columnSpanFull(),
                ]),

                Step::make('Webshop')->translateLabel()->schema([
                    FileUpload::make('products_csv_file')
                        ->translateLabel()
                        ->visible($visibility->products_csv_file_visible)
                        ->maxSize(2048)
                        ->maxFiles(1)
                        ->downloadable()
                        ->disk('public')
                        ->directory('products_csv_file')
                        ->visibility('public')
                        ->preserveFilenames(),
                    Repeater::make('highlighted_categories')
                        ->translateLabel()
                        ->visible($visibility->highlighted_categories_visible)
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
                                ->fileAttachmentsDirectory('categories/attachments')
                                ->fileAttachmentsVisibility('public'),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    Select::make('bruto_netto')
                        ->translateLabel()
                        ->visible($visibility->bruto_netto_visible)
                        ->options([
                            'bruto' => 'bruto',
                            'netto' => 'netto',
                        ]),
                    TextInput::make('store_address')
                        ->translateLabel()
                        ->visible($visibility->store_address_visible)
                        ->maxLength(255),
                    TextInput::make('shipping_address')
                        ->translateLabel()
                        ->visible($visibility->shipping_address_visible)
                        ->maxLength(255),
                    Select::make('parcel_points')
                        ->translateLabel()
                        ->visible($visibility->parcel_points_visible)
                        ->options([
                            'gls' => 'GLS',
                            'dpd' => 'DPD',
                            'dhl' => 'DHL',
                            'mpl' => 'MPL',
                        ])->multiple(),
                    Toggle::make('have_contracted_accountant')
                        ->translateLabel()
                        ->visible($visibility->have_contracted_accountant_visible),
                    Repeater::make('contracted_accountants')
                        ->translateLabel()
                        ->visible($visibility->contracted_accountants_visible)
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
                        ->visible($visibility->payment_methods_visible)
                        ->multiple()
                        ->options([
                            'cash' => 'cash',
                            'credit_card' => 'credit card',
                            'bank_transfer' => 'bank transfer',
                            'paypal' => 'PayPal',
                        ]),
                    Toggle::make('have_contracted_online_bank_card_payment')
                        ->translateLabel()
                        ->visible($visibility->have_contracted_online_bank_card_payment_visible),
                    Repeater::make('online_bank_card_payment_options')
                        ->translateLabel()
                        ->visible($visibility->online_bank_card_payment_options_visible)
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

                ]),
                Step::make('Véglegesítés')->translateLabel()->schema([
                    Checkbox::make('consent')
                        ->live()
                        ->label('I agree to the terms and conditions(note:later has link)')
                        ->translateLabel()
                        ->default(false)
                        ->helperText(__('You must agree to the terms and conditions to proceed.'))
                        ->required()
                        ->accepted(true),
                    Checkbox::make('privacy_policy')
                        ->live()
                        ->label('I agree to the processing of my personal data in accordance with the privacy policy(note:later has link)')
                        ->translateLabel()
                        ->default(false)
                        ->helperText(__('You must agree to the processing of your personal data in accordance with the privacy policy to proceed.'))
                        ->required()
                        ->accepted(true),
                    Checkbox::make('consent_start')
                        ->live()
                        ->label('I acknowledge that work can begin')
                        ->translateLabel()
                        ->default(false)
                        ->helperText(__('You must acknowledge that work can begin to proceed.'))
                        ->required()
                        ->accepted(true),
                ]), ])
                ->skippable()
                ->submitAction($this->submitButtonAction($this->data)),
        ])
            ->statePath('data')
            ->model(FormQuestion::class);
    }

    public function submitButtonAction($data): SubmitButton
    {
        dump($data);

        return SubmitButton::make('submit')
            ->view('filament.forms.components.form-question-submit-button', ['data' => $data]);
    }

    public function updateAndClose()
    {
        $data = $this->form->getState();

        $data['status'] = FormQuestionStatus::SUBMITTED;

        $record = FormQuestion::update($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->route('filament.dashboard.resources.form-questions.view', ['record' => $record]);
    }

    public function updateAndDraft(): void
    {
        $data = $this->form->getState();

        $this->post->update($data);
        $data['status'] = FormQuestionStatus::TEMPORARILY_SAVED;
        $this->form->saveRelationships();

        Notification::make()
            ->title('Save successful')
            ->success()
            ->icon('heroicon-o-check-circle')
            ->send();
    }

    public function render(): View
    {
        return view('livewire.form-question-form');
    }
}
