<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\ClientType;
use App\Enums\RolesEnum;
use App\Mail\QuotationSendedToUser;
use App\Models\RequestQuote;
use App\Models\RequestQuoteFunctionality;
use App\Models\User;
use App\Models\WebsiteLanguage;
use Filament\Actions\Action as SubmitButton;
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
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class GuestShowQuaotationForm extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    #[Validate([
        'data.name' => ['required', 'string', 'max:255'],
        'data.email' => ['required', 'email', 'max:255'],
        'data.phone' => ['required', 'string', 'max:255'],
        'data.company_name' => ['nullable', 'string', 'max:255'],
        'data.company_address' => ['nullable', 'string', 'max:255'],
        'data.company_vat_number' => ['nullable', 'string', 'max:255'],
        'data.client_type' => ['nullable', 'string', 'in:individual,company'],
        'data.website_type_id' => ['required', 'exists:website_types,id'],
        'data.website_engine' => ['required', 'string', 'max:255'],
        'data.websites' => ['array'],
        'data.websites.*.name' => ['required', 'string', 'max:255'],
        'data.websites.*.length' => ['required', 'string', 'in:short,medium,large'],
        'data.have_website_graphic' => ['nullable', 'boolean'],
        'data.requestQuoteFunctionalities' => ['array'],
        'data.requestQuoteFunctionalities.*' => ['exists:request_quote_functionalities,id'],
        'data.is_multilangual' => ['nullable', 'boolean'],
        'data.languages' => ['array'],
        'data.languages.*' => ['exists:website_languages,id'],
    ])]
    public ?array $data = [];

    public function mount(): void
    {
        if (Auth::check()) {
            $this->data['name'] = Auth::user()->name;
            $this->data['email'] = Auth::user()->email;
            $this->data['phone'] = Auth::user()->phone;
            $this->data['company_name'] = Auth::user()->company_name;
            $this->data['company_address'] = Auth::user()->company_address;
            $this->data['company_vat_number'] = Auth::user()->company_vat_number;
        }

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
                    ->submitAction($this->submitButtonAction()),
            ])
            ->statePath('data')
            ->model(RequestQuote::class);
    }

    public function submitButtonAction(): SubmitButton
    {
        $form = $this->data;

        return SubmitButton::make('submit')
            ->view('filament.forms.components.quotation-submit-button', ['data' => $form]);
    }

    public function createRequestQuoteAction(): SubmitButton
    {
        return SubmitButton::make('createRequestQuoteAction')
            ->action(function () {
                $data = $this->form->getState();
                $data['user_id'] = Auth::id();
                $requestQuote = RequestQuote::create($data);

                $this->form->model($requestQuote)->saveRelationships();
                // save to session
                Session::put('requestQuote', $requestQuote->id);
                $this->redirect(route('filament.dashboard.resources.request-quotes.index'));
            })
            ->label(__('Create Request Quote'))
            ->color('primary')
            ->icon('heroicon-o-paper-airplane');
    }

    public function orderAction(): SubmitButton
    {
        return SubmitButton::make('order')
            ->action(function (): void {
                $data = $this->form->getState();
                $data['user_id'] = Auth::id();
                $requestQuote = RequestQuote::create($data);

                $this->form->model($requestQuote)->saveRelationships();
                // save to session
                Session::put('requestQuote', $requestQuote->id);
                $this->redirect(route('cart.summary', ['requestQuote' => $requestQuote->id]));
            })
            ->label(__('Order'))
            ->color('primary')
            ->icon('heroicon-o-paper-airplane');
    }

    public function registerAndSendAction(): SubmitButton
    {
        return SubmitButton::make('registerAndSendAction')
            ->label(__('Register and Create Quotation'))

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
                        ->title(__('Email already registered'))
                        ->body(__('This email is already registered. Please use a different email address.'))
                        ->danger()
                        ->send();
                    $this->halt();

                }

                return [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'company_name' => $data['company_name'] ?? null,
                    'company_address' => $data['company_address'] ?? null,
                    'company_vat_number' => $data['company_vat_number'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                ];
            })->form([
                Select::make('client_type')
                    ->label('Legal form')
                    ->live()
                    ->required()
                    ->translateLabel()
                    ->options(ClientType::class),
                TextInput::make('company_name')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_registration_number')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Full Name')
                    ->translateLabel()
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->translateLabel()
                    ->email()
                    ->unique('users', 'email')
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->translateLabel()
                    ->tel()
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->confirmed()
                    ->translateLabel()
                    ->password()
                    ->revealable()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password_confirmation')
                    ->translateLabel()
                    ->password()
                    ->revealable()
                    ->required(),
            ])->action(function (array $data) {
                $fillDataForRegister = $data;
                $data = $this->form->getState();
                $validatedfillDataForRegister = Validator::make($fillDataForRegister, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'phone' => ['required', 'string', 'max:255'],
                    'company_name' => ['nullable', 'string', 'max:255'],
                    'company_address' => ['nullable', 'string', 'max:255'],
                    'company_vat_number' => ['nullable', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ])->validate();

                $user = User::create([
                    'name' => $validatedfillDataForRegister['name'],
                    'email' => $validatedfillDataForRegister['email'],
                    'phone' => $validatedfillDataForRegister['phone'],
                    'company_name' => $validatedfillDataForRegister['company_name'] ?? null,
                    'company_address' => $validatedfillDataForRegister['company_address'] ?? null,
                    'company_vat_number' => $validatedfillDataForRegister['company_vat_number'] ?? null,
                    'password' => Hash::make($validatedfillDataForRegister['password']),

                ]);
                $user->assignRole(RolesEnum::GUEST);
                event(new Registered($user));
                Auth::loginUsingId($user->id, true);
                $data['user_id'] = Auth::id();

                $requestQuote = RequestQuote::create($data);

                Notification::make()
                    ->title(__('Quotation created and order placed'))
                    ->success()
                    ->send();

                $this->form->model($requestQuote)->saveRelationships();

                Session::put('requestQuote', $requestQuote->id);

                return $this->redirect(route('filament.dashboard.pages.dashboard'));
            })
            ->color('success')
            ->icon('heroicon-o-paper-airplane');
    }

    public function orderAndRegisterAction(): SubmitButton
    {
        return SubmitButton::make('orderAndRegisterAction')
            ->label(__('Register and Order'))

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
                }

                return [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'company_name' => $data['company_name'] ?? null,
                    'company_address' => $data['company_address'] ?? null,
                    'company_vat_number' => $data['company_vat_number'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'password' => $data['password'] ?? null,
                    'password_confirmation' => $data['password_confirmation'] ?? null,
                ];
            })->form([
                Select::make('client_type')
                    ->label('Legal form')
                    ->live()
                    ->required()
                    ->translateLabel()
                    ->options(ClientType::class),
                TextInput::make('company_name')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_vat_number')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Full Name')
                    ->translateLabel()
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->translateLabel()
                    ->email()
                    ->unique('users', 'email')
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->translateLabel()
                    ->tel()
                    ->live()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->confirmed()
                    ->translateLabel()
                    ->password()
                    ->revealable()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password_confirmation')
                    ->translateLabel()
                    ->password()
                    ->revealable()
                    ->required(),
            ])->action(function (array $data) {
                $fillDataForRegister = $data;
                $data = $this->form->getState();
                $validatedfillDataForRegister = Validator::make($fillDataForRegister, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'phone' => ['required', 'string', 'max:255'],
                    'company_name' => ['nullable', 'string', 'max:255'],
                    'company_address' => ['nullable', 'string', 'max:255'],
                    'company_registration_number' => ['nullable', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ])->validate();

                $user = User::create([
                    'name' => $validatedfillDataForRegister['name'],
                    'email' => $validatedfillDataForRegister['email'],
                    'phone' => $validatedfillDataForRegister['phone'],
                    'company_name' => $validatedfillDataForRegister['company_name'] ?? null,
                    'company_address' => $validatedfillDataForRegister['company_address'] ?? null,
                    'company_vat_number' => $validatedfillDataForRegister['company_vat_number'] ?? null,
                    'password' => Hash::make($validatedfillDataForRegister['password']),
                ]);
                $user->assignRole(RolesEnum::GUEST);
                event(new Registered($user));
                Auth::loginUsingId($user->id, true);
                $data['user_id'] = Auth::id();
                $requestQuote = RequestQuote::create($data);

                Notification::make()
                    ->title(__('Quotation created and order placed'))
                    ->success()
                    ->send();

                $this->form->model($requestQuote)->saveRelationships();

                Session::put('requestQuote', $requestQuote->id);

                return $this->redirect(route('cart.summary', ['requestQuote' => $requestQuote->id]));
            })
            ->color('success')
            ->icon('heroicon-o-paper-airplane');

    }

    public function sendEmailToMeAction(): SubmitButton
    {
        return SubmitButton::make('sendEmailToMeAction')
            ->action(function () {
                $data = $this->form->getState();
                $record = RequestQuote::create($data);
                Notification::make()
                    ->title('Quotation created and email sent')
                    ->success()
                    ->send();
                $this->form->model($record)->saveRelationships();

                Mail::to($data['email'])->send(new QuotationSendedToUser($record));

                return $this->redirect(route('email-sended-to-user'));
            })

            ->label(__('Send email to me'))
            ->color('success')
            ->icon('heroicon-o-envelope');
    }

    public function render(): View
    {
        return view('livewire.guest-show-quaotation-form');
    }

    private function getClientInformationSchema(): Step
    {
        return
        Step::make('Client Informations')->translateLabel()->schema(
            [
                ViewField::make('welcomeText')->view(
                    'filament.forms.components.welcome'
                ),
                Grid::make(2)->schema([

                    Select::make('website_type_id')
                        ->live()
                        ->required()
                        ->translateLabel()
                        ->relationship('websiteType', 'name', function ($query) {

                            $order = ['weboldal', 'webshop', 'landing page'];

                            return $query->whereIn('name', $order)
                                ->orderByRaw("FIELD(name, '".implode("','", $order)."')");

                        })
                        ->afterStateUpdated(function (Set $set): void {
                            $set('request_quote_functionalities', []);
                        })
                        ->hintAction(function (): Action {
                            return Action::make('help')
                                ->icon('heroicon-o-question-mark-circle')
                                ->extraAttributes(['class' => 'text-gray-500'])
                                ->label('')
                                ->tooltip(function ($state) {
                                    return __('Filament/pages/request-quote.website_type_tooltip');
                                });
                        })
                        ->preload(),
                    Select::make('website_engine')
                        ->live()
                        ->hintAction(function (): Action {
                            return Action::make('help')
                                ->icon('heroicon-o-question-mark-circle')
                                ->extraAttributes(['class' => 'text-gray-500'])
                                ->label('')
                                ->tooltip(function ($state) {
                                    return match ($state) {
                                        'wordpress' => __('Filament/pages/request-quote.website_engine_wordpress_tooltip'),
                                        'laravel' => __('Filament/pages/request-quote.website_engine_laravel_tooltip'),
                                        'shopify' => __('Filament/pages/request-quote.website_engine_shopify_tooltip'),
                                        default => __('Filament/pages/request-quote.website_engine_tooltip'),
                                    };
                                });
                        })
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
                                    ->label(__('Page description'))
                                    ->maxLength(65535)
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                        'codeBlock',
                                        'italic',
                                        'strikeThrough',
                                        'underline',
                                    ])
                                    ->columnSpanFull(),
                                FileUpload::make('images')
                                    ->translateLabel()
                                    ->label('Adott oldalhoz esetleges igényelt képek forfeltöltése')
                                    ->visible(fn ($get) => $get('required'))
                                    ->disk('public')
                                    ->directory('website-images')
                                    ->openable()
                                    ->downloadable()
                                    ->reorderable()
                                    ->maxFiles(10)
                                    ->acceptedFileTypes(['jpg', 'jpeg', 'png', 'gif'])
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
                    ])->addActionLabel(__('Filament/pages/request-quote.repeter_webpage_add_test'))
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
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

                        ]),

                ]),
            ]);
    }

    private function getGraphicsInformationSchema(): Step
    {
        return Step::make('Grafics and functions')->translateLabel()->schema([
            Grid::make(1)->schema([
                RichEditor::make('project_description')
                    ->placeholder('Kérjük, írja le részletesen weboldal-projektjét, maximum 20 000 karakter terjedelemben. Itt lehetősége van megosztani velünk elképzeléseit a weboldal céljával, célközönségével, kívánt hangulatával, preferált színeivel vagy stílusával kapcsolatban, valamint bármilyen egyéb, releváns információt, amely segíthet a projekt megértésében. A weboldal specifikus funkcióit, valamint a nyelvesítési igényeket kérjük, az oldal alján található külön beállítási lehetőségeknél adja meg.')
                    ->translateLabel()
                    ->maxLength(20000)
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
                    ->hidden(true)
                    ->disabled(),
                ViewField::make('have_website_graphic')
                    ->view('filament.forms.components.have-website-graphic'),
                Actions::make([
                    Action::make('yes')
                        ->translateLabel()
                        ->requiresConfirmation()
                        ->modalHeading(__('Website graphic'))
                        ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                        ->modalSubmitActionLabel(__('Yes, sure I do'))
                        ->modalCancelActionLabel(__('Cancel'))
                        ->modalAlignment(Alignment::Center)
                        ->color(fn ($livewire): string => $livewire->data['have_website_graphic'] === true ? 'primary' : 'gray')
                        ->action(function (Set $set): void {
                            $set('have_website_graphic', true);
                        }),
                    Action::make('no')
                        ->translateLabel()
                        ->requiresConfirmation()
                        ->modalHeading(__('Website graphic'))
                        ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                        ->modalCancelActionLabel(__('Cancel'))
                        ->modalSubmitActionLabel(__('Igen, biztosan nincs'))
                        ->modalAlignment(Alignment::Center)
                        ->color(fn ($livewire): string => $livewire->data['have_website_graphic'] === false ? 'primary' : 'gray')
                        ->action(function (Set $set): void {
                            $set('have_website_graphic', false);

                        }),
                ])->label('Do you have a website graphic?')->translateLabel(),
            ]),
            CheckboxList::make('request_quote_functionalities')
                ->translateLabel()
                ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                    return $query->where('website_type_id', $get('website_type_id'))?->notDefault();
                })
                ->getOptionLabelFromRecordUsing(fn (Model $record): string => sprintf('%s', $record->name))
                ->disabled(fn ($get): bool => $get('website_type_id') === null)
                ->descriptions(function (Get $get) {
                    return RequestQuoteFunctionality::whereWebsiteTypeId($get('website_type_id'))->notDefault()->pluck('description', 'id')->toArray();
                }),
            Toggle::make('is_multilangual')
                ->translateLabel()
                ->live(),
            Select::make('default_language')
                ->translateLabel()
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
                TextInput::make('name')
                    ->label('Full Name')
                    ->translateLabel()
                    ->live()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn () => ! Auth::check()),
                TextInput::make('email')
                    ->translateLabel()
                    ->email()
                    ->live()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn () => ! Auth::check()),
                TextInput::make('phone')
                    ->translateLabel()
                    ->tel()
                    ->live()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn () => ! Auth::check()),
                Select::make('client_type')
                    ->label('Legal form')
                    ->translateLabel()
                    ->live()
                    ->required()
                    ->options(ClientType::class)
                    ->preload()
                    ->visible(fn () => ! Auth::check()),
                TextInput::make('company_name')
                    ->translateLabel()
                    ->visible(fn ($get) => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn ($get) => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->translateLabel()
                    ->visible(fn ($get) => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_contact_name')
                    ->translateLabel()
                    ->visible(fn ($get) => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn ($get) => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
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
}
