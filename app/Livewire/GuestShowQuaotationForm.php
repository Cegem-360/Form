<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\ClientType;
use App\Mail\QuotationSendedToUser;
use App\Models\RequestQuote;
use App\Models\User;
use App\Models\WebsiteLanguage;
use Filament\Actions\Action as SubbmitButton;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Alignment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GuestShowQuaotationForm extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    #[Validate([
        'data.name' => ['required', 'string', 'max:255'],
        'data.email' => ['required', 'email', 'max:255'],
        'data.phone' => ['required', 'string', 'max:255'],
        'data.company_name' => ['nullable', 'string', 'max:255'],
        'data.website_type_id' => ['required', 'exists:website_types,id'],
        'data.website_engine' => ['required', 'string', 'max:255'],
        'data.websites' => ['array'],
        'data.websites.*.name' => ['required', 'string', 'max:255'],
        'data.websites.*.length' => ['required', 'string', 'in:short,medium,long'],
        'data.have_website_graphic' => ['boolean'],
        'data.requestQuoteFunctionalities' => ['array'],
        'data.requestQuoteFunctionalities.*' => ['exists:request_quote_functionalities,id'],
        'data.is_multilangual' => ['nullable', 'boolean'],
        'data.languages' => ['array'],
        'data.languages.*' => ['exists:website_languages,id'],
        'data.is_ecommerce' => ['boolean'],
        'data.ecommerce_functionalities' => ['nullable', 'string'],
    ])]
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    $this->getClientInformationSchema(),
                    $this->getWebsiteInformationSchema(),
                    $this->getGraphicsInformationSchema(),
                    $this->getConstentSchema(),
                ])
                    ->skippable()
                    ->submitAction($this->subbmitButtonAction()),
            ])
            ->statePath('data')
            ->model(RequestQuote::class);
    }

    public function subbmitButtonAction(): SubbmitButton
    {
        $form = $this->data;

        return SubbmitButton::make('submit')
            ->view('filament.forms.components.quotation-submit-button', ['data' => $form]);
    }

    public function orderAction(): SubbmitButton
    {
        return SubbmitButton::make('order')
            ->action(function (): void {
                $data = $this->form->getState();
                $record = RequestQuote::create($data);

                Notification::make()
                    ->title('Quotation created and order placed')
                    ->success()
                    ->send();

                $this->form->model($record)->saveRelationships();
                // save to session
                Session::put('requestQuote', $record->id);
                $this->redirect(route('cart.summary', ['requestQuote' => $record->id]), true);
            })
            ->label(__('Order'))
            ->color('primary')
            ->icon('heroicon-o-paper-airplane');
    }

    public function orderAndRegisterAction(): SubbmitButton
    {
        return SubbmitButton::make('Register')
            ->action(function (array $data): void {
                $fillForRegister = $data;
                $data = $this->form->getState();
                // user create and login and navigate to guestViewQuotationOrder

                /**
                 * TODO - add email verification
                 * TODO - add permissions and roles
                 * TODO - add email verification
                 */
                $user = User::create([
                    'name' => $fillForRegister['name'],
                    'email' => $fillForRegister['email'],
                    'phone' => $fillForRegister['phone'],
                    'company_name' => $fillForRegister['company_name'] ?? null,
                    'company_address' => $fillForRegister['company_address'] ?? null,
                    'company_vat_number' => null,
                    'company_registration_number' => $fillForRegister['company_registration_number'] ?? null,
                    'password' => Hash::make('password'), // or use a random password
                ]);
                $user->assignRole('guest');
                event(new Registered($user));
                Auth::loginUsingId($user->id, true);
                $record = RequestQuote::create($data);

                Notification::make()
                    ->title('Quotation created and order placed')
                    ->success()
                    ->send();

                $this->form->model($record)->saveRelationships();

                // Redirect to Cart summary page
                $this->redirect(route('cart.summary', ['requestQuote' => $record->id]), true);
            })
            ->requiresConfirmation()
            ->modalHeading(__('Register'))
            ->modalDescription(__('Are you sure you want to register?'))
            ->modalSubmitActionLabel(__('Register'))
            ->modalCancelActionLabel(__('Cancel'))
            ->modalAlignment(Alignment::Center)
            ->fillForm(function (): array {
                $data = $this->form->getState();
                if (User::where('email', $data['email'])->exists()) {
                    Notification::make()
                        ->title('Email already registered')
                        ->body('This email is already registered. Please use a different email address.')
                        ->danger()
                        ->send();

                    return [
                        'name' => $data['name'],
                        'phone' => $data['phone'],
                        'company_name' => $data['company_name'] ?? null,
                        'company_address' => $data['company_address'] ?? null,
                        'company_vat_number' => null,
                        'company_registration_number' => $data['company_registration_number'] ?? null,
                        'client_type' => $data['client_type'] ?? null,
                    ];
                }

                return [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'company_name' => $data['company_name'] ?? null,
                    'company_address' => $data['company_address'] ?? null,
                    'company_vat_number' => null,
                    'company_registration_number' => $data['company_registration_number'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                ];
            })->form([
                Select::make('client_type')
                    ->live()
                    ->required()
                    ->options(ClientType::class)
                    ->preload()
                    ->searchable(),
                TextInput::make('company_name')
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_registration_number')
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Full Name')
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->unique(User::class, 'email')
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->live()
                    ->required()
                    ->maxLength(255),
            ])
            ->label(__('Register'))
            ->color('success')
            ->icon('heroicon-o-paper-airplane');

    }

    public function sendEmailToMeAction(): SubbmitButton
    {
        return SubbmitButton::make('sendEmailToMeAction')
            ->action(function (): void {
                $data = $this->form->getState();
                $record = RequestQuote::create($data);
                Notification::make()
                    ->title('Quotation created and email sent')
                    ->success()
                    ->send();
                $this->form->model($record)->saveRelationships();

                Mail::to($data['email'])->send(new QuotationSendedToUser($record));
                $this->redirect(route('email-sended-to-user'), true);
            })
            ->label(__('Send email to me'))
            ->color('success')
            ->icon('heroicon-o-envelope');
    }

    private function getClientInformationSchema(): Step
    {
        return
        Step::make('Client Information')->translateLabel()->schema(
            [
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Full Name')
                        ->translateLabel()
                        ->live()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->translateLabel()
                        ->email()
                        ->live()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->translateLabel()
                        ->tel()
                        ->live()
                        ->required()
                        ->maxLength(255),
                    Select::make('client_type')
                        ->label('Legal form')
                        ->translateLabel()
                        ->live()
                        ->required()
                        ->options(ClientType::class)
                        ->preload()
                        ->searchable(),
                    TextInput::make('company_name')
                        ->translateLabel()
                        ->visible(fn ($get): bool => $get('client_type') === ClientType::COMPANY->value)
                        ->required(fn ($get): bool => $get('client_type') === ClientType::COMPANY->value)
                        ->maxLength(255),
                    TextInput::make('company_address')
                        ->translateLabel()
                        ->visible(fn ($get): bool => $get('client_type') === ClientType::COMPANY->value)
                        ->required(fn ($get): bool => $get('client_type') === ClientType::COMPANY->value)
                        ->maxLength(255),
                    TextInput::make('company_contact_name')
                        ->translateLabel()
                        ->visible(fn ($get): bool => $get('client_type') === ClientType::COMPANY->value)
                        ->required(fn ($get): bool => $get('client_type') === ClientType::COMPANY->value)
                        ->maxLength(255),
                    Select::make('website_type_id')
                        ->live()
                        ->required()
                        ->translateLabel()
                        ->relationship('websiteType', 'name')
                        ->afterStateUpdated(function (Set $set): void {
                            $set('request_quote_functionalities', []);
                        })
                        ->preload(),
                    Select::make('website_engine')
                        ->translateLabel()
                        ->options([
                            'wordpress' => 'Wordpress',
                            'laravel' => 'Laravel',
                            'shopify' => 'Shopify',
                        ])->required(),

                ]),
            ]);
    }

    private function getWebsiteInformationSchema(): Step
    {
        return Step::make('Website Informations')->translateLabel()
            ->schema([
                Grid::make(1)->schema([
                    Repeater::make('websites')->translateLabel()->deletable(false)->schema([
                        Grid::make(2)->columnSpan(1)->schema([
                            Grid::make(2)->columnSpan(1)->schema([
                                TextInput::make('name')
                                    ->translateLabel()
                                    ->required()
                                    ->distinct(),
                                ToggleButtons::make('required')
                                    ->label('Want to this page?')
                                    ->translateLabel()
                                    ->live()
                                    ->options([
                                        '1' => __('Yes'),
                                        '0' => __('No'),
                                    ])
                                    ->default('0')
                                    ->inline()
                                    ->required(),
                                ToggleButtons::make('length')
                                    ->label('Content length')
                                    ->translateLabel()
                                    ->live()
                                    ->visible(fn ($get) => $get('required'))
                                    ->default('medium')
                                    ->required(fn ($get) => $get('required'))
                                    ->options([
                                        'short' => __('Short'),
                                        'medium' => __('Medium'),
                                        'large' => __('Large'),
                                    ])
                                    ->inline()
                                    ->afterStateUpdated(function ($state, Set $set): void {
                                        $set('image', $state);
                                    })
                                    ->required()
                                    ->columnSpanFull(),
                                RichEditor::make('description')
                                    ->translateLabel()
                                    ->visible(fn ($get) => $get('required'))
                                    ->label('Részletes leírás')
                                    ->maxLength(65535)
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                        'codeBlock',
                                        'italic',
                                        'strikeThrough',
                                        'underline',
                                    ])
                                    ->columnSpanFull(),
                                FileUpload::make('image')
                                    ->translateLabel()
                                    ->label('Image')
                                    ->visible(fn ($get) => $get('required'))
                                    ->disk('public')
                                    ->directory('website-images')
                                    ->openable()
                                    ->downloadable()
                                    ->reorderable()
                                    ->maxFiles(10)
                                    ->acceptedFileTypes(['jpg', 'jpeg', 'png', 'gif'])
                                    ->required(fn ($get) => $get('required'))
                                    ->helperText(__('You can upload multiple images'))
                                    ->columnSpanFull(),

                            ]),
                            Grid::make(1)->columnSpan(1)->schema([
                                ViewField::make('image')
                                    ->view('filament.forms.components.image')
                                    ->viewData(
                                        [
                                            'image' => fn (Get $get): mixed => $get('image'), // gets the image from the state
                                            'show_image' => true, // hides the image
                                        ]
                                    ),
                            ]),
                        ]),
                    ])->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->minItems(1)
                        ->maxItems(30)
                        ->collapsible()
                        ->defaultItems(10)
                        ->default([
                            [
                                'name' => 'Főoldal',
                                'length' => 'medium',
                                'required' => '1',
                            ],
                            [
                                'name' => 'Kapcsolati',
                                'length' => 'medium',
                                'required' => '1',
                            ],
                            [
                                'name' => 'Rólunk',
                                'length' => 'medium',
                                'required' => '0',
                            ],
                            [
                                'name' => 'Szolgáltatások',
                                'length' => 'medium',
                                'required' => '0',
                            ],
                            [
                                'name' => 'Blog',
                                'length' => 'medium',
                                'required' => '0',
                            ],
                            [
                                'name' => 'Gyakori kérdések',
                                'length' => 'medium',
                                'required' => '0',
                            ],
                            [
                                'name' => 'Adatvédelmi nyilatkozat',
                                'length' => 'medium',
                                'required' => '0',
                            ],
                            [
                                'name' => 'Általános szerződési feltételek',
                                'length' => 'medium',
                                'required' => '0',
                            ],
                            [
                                'name' => 'Webshop',
                                'length' => 'medium',
                                'required' => '0',
                            ],

                        ])
                        ->addActionLabel(__('Add Website')),

                ]),
            ]);
    }

    private function getGraphicsInformationSchema(): Step
    {
        return Step::make('Grafics and functions')->translateLabel()->schema([
            Grid::make(1)->schema([
                RichEditor::make('project_description')
                    ->translateLabel()
                    ->maxLength(65535)
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                        'italic',
                        'strikeThrough',
                        'underline',
                    ])->columnSpanFull(),
                Toggle::make('have_website_graphic')
                    ->default(false)
                    ->label('Do you have a website graphic?')
                    ->translateLabel()
                    ->disabled(),
                Actions::make([
                    Action::make('yes')
                        ->translateLabel()
                        ->requiresConfirmation()
                        ->modalHeading(__('Website graphic'))
                        ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                        ->modalSubmitActionLabel(__('Yes, I have a website graphic'))
                        ->modalCancelActionLabel(__("No, I don't have a website graphic"))
                        ->modalAlignment(Alignment::Center)
                        ->action(function (Set $set): void {
                            $set('have_website_graphic', true);
                        }),
                    Action::make('no')
                        ->translateLabel()
                        ->requiresConfirmation()
                        ->modalHeading(__('Website graphic'))
                        ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                        ->modalSubmitActionLabel("No, I don't have a website graphic")
                        ->modalAlignment(Alignment::Center)
                        ->action(function (Set $set): void {
                            $set('have_website_graphic', false);
                        }),
                ])->label('Do you have a website graphic?')->translateLabel(),
            ]),
            CheckboxList::make('request_quote_functionalities')
                ->translateLabel()
                ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                    return $query->where('website_type_id', $get('website_type_id'));
                })
                ->getOptionLabelFromRecordUsing(fn (Model $record): string => sprintf('%s %s', $record->name, $record->websiteType()->first()->name))
                ->disabled(fn ($get): bool => $get('website_type_id') === null),
            Toggle::make('is_multilangual')
                ->translateLabel()
                ->live(),
            Select::make('default_language')
                ->translateLabel()
                ->live()
                ->visible(fn ($get) => $get('is_multilangual'))
                ->default(WebsiteLanguage::whereName('Hungarian')->first()->id)
                ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                ->preload()
                ->afterStateUpdated(function (Set $set): void {
                    $set('languages', []);
                })
                ->searchable(),
            Select::make('languages')
                ->translateLabel()
                ->multiple()
                ->visible(fn ($get) => $get('is_multilangual'))
                ->options(function (Get $get) {
                    return WebsiteLanguage::whereNot('id', '=', $get('default_language'))->pluck('name', 'id');
                })
                ->searchable(),
        ]);
    }

    private function getConstentSchema(): Step
    {
        return Step::make('Consent')->translateLabel()->schema([
            Grid::make(1)->schema([
                Checkbox::make('consent')
                    ->live()
                    ->default(false)
                    ->label('I agree to the terms and conditions(note:later has link)')
                    ->translateLabel()
                    ->required()
                    ->helperText(__('You must agree to the terms and conditions to proceed.'))
                    ->rules(['accepted']),
                Checkbox::make('privacy_policy')
                    ->live()
                    ->label('I agree to the processing of my personal data in accordance with the privacy policy(note:later has link)')
                    ->translateLabel()
                    ->default(false)
                    ->helperText(__('You must agree to the processing of your personal data in accordance with the privacy policy to proceed.'))
                    ->required()
                    ->rules(['accepted']),
            ]),
        ]);
    }

    public function render(): View
    {
        return view('livewire.guest-show-quaotation-form');
    }
}
