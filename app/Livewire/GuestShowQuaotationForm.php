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
use App\Models\WebsiteType;
use Filament\Actions\Action as SubmitButton;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
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
use Livewire\Component;

final class GuestShowQuaotationForm extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public RequestQuoteFunctionality $requestQuoteFunctionality;

    /*  public function mount(): void
     {


     } */

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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ->action(function (): void {
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
            ->modalSubmitActionLabel(__('Register'))
            ->modalCancelActionLabel(__('Cancel'))
            ->modalAlignment(Alignment::Center)
            ->fillForm(function (): array {
                return $this->form->getState();
            })
            ->schema($this->getRegistrationFormSchema())
            ->action(function (array $data) {

                $fillDataForRegister = $data;
                $data = $this->form->getState();
                $validatedfillDataForRegister = Validator::make($fillDataForRegister, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'phone' => ['required', 'string', 'max:255'],
                    'company_name' => ['nullable', 'string', 'max:255'],
                    'company_address' => ['nullable', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ])->validate();

                $user = User::create([
                    'name' => $validatedfillDataForRegister['name'],
                    'email' => $validatedfillDataForRegister['email'],
                    'phone' => $validatedfillDataForRegister['phone'],
                    'company_name' => $validatedfillDataForRegister['company_name'] ?? null,
                    'company_address' => $validatedfillDataForRegister['company_address'] ?? null,
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

    public function registerAndOrderAction(): SubmitButton
    {
        return SubmitButton::make('registerAndOrderAction')
            ->label(__('Register and Order'))
            ->requiresConfirmation()
            ->modalHeading(__('Register'))
            ->modalSubmitActionLabel(__('Register'))
            ->modalCancelActionLabel(__('Cancel'))
            ->modalAlignment(Alignment::Center)
            ->fillForm(function (): array {
                return $this->form->getState();
            })
            ->schema($this->getRegistrationFormSchema())
            ->action(function (array $data) {
                $dataTmp = $this->form->getState();
                $validatedfillDataForRegister = Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'phone' => ['required', 'string', 'max:255'],
                    'company_name' => ['nullable', 'string', 'max:255'],
                    'company_address' => ['nullable', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ])->validate();
                $user = User::create([
                    'name' => $validatedfillDataForRegister['name'],
                    'email' => $validatedfillDataForRegister['email'],
                    'phone' => $validatedfillDataForRegister['phone'],
                    'company_name' => $validatedfillDataForRegister['company_name'] ?? null,
                    'company_address' => $validatedfillDataForRegister['company_address'] ?? null,
                    'password' => Hash::make($validatedfillDataForRegister['password']),
                ]);
                $user->assignRole(RolesEnum::GUEST);
                event(new Registered($user));
                Auth::loginUsingId($user->id, true);
                $dataTmp['user_id'] = Auth::id();
                $requestQuote = RequestQuote::create($dataTmp);

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

                Mail::to($data['email'])->send(new QuotationSendedToUser($record));

                return $this->redirect(route('email-sended-to-user'));
            })

            ->label(__('Send email to me'))
            ->color('success')
            ->icon('heroicon-o-envelope');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render(): View
    {
        return view('livewire.guest-show-quaotation-form');
    }

    private function getClientInformationSchema(): Step
    {
        return Step::make('Client Informations')

            ->schema(
                [
                    ViewField::make('welcomeText')->view(
                        'filament.forms.components.welcome'
                    ),
                    Grid::make(2)->gridContainer()->schema([
                        Select::make('website_type_id')
                            ->live()
                            ->required()
                            ->preload()
                            ->relationship('websiteType', 'name', function ($query) {
                                $order = ['weboldal', 'webshop', 'landing page'];

                                return $query->whereIn('name', $order)
                                    ->orderByRaw("FIELD(name, '".implode("','", $order)."')");
                            })
                            ->afterStateUpdated(function (Set $set, $state): void {
                                $set('request_quote_functionalities', []);
                                if (WebsiteType::find($state)->name === 'Webshop') {
                                    $set('websites', $this->webshop());
                                } elseif (WebsiteType::find($state)->name === 'Weboldal') {
                                    $set('websites', $this->website());
                                } elseif (WebsiteType::find($state)->name === 'Landing Page') {
                                    $set('websites', $this->landingPage());
                                } else {
                                    $set('websites', []);
                                }
                            })
                            ->hintAction(
                                SubmitButton::make('help')
                                    ->icon('heroicon-o-question-mark-circle')
                                    ->extraAttributes(['class' => 'text-gray-500'])
                                    ->label('')
                                    ->tooltip(function ($state) {
                                        return __('Filament/pages/request-quote.website_type_tooltip');
                                    })
                            ),
                        Select::make('website_engine')
                            ->live()
                            ->hintAction(
                                SubmitButton::make('help')
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
                                    })
                            )

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
        return Step::make('Website Informations')->schema([
            Grid::make(1)->schema([
                Repeater::make('websites')->schema([
                    Grid::make(2)->columnSpan(1)->schema(
                        [
                            Grid::make(2)->columnSpan(1)
                                ->schema($this->getWebsiteRepererSchema()),
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

    private function getGraphicsInformationSchema(): Step
    {
        return Step::make('Grafics and functions')->schema([Grid::make(2)->schema([
            TextInput::make('quotation_name')
                ->columnSpan(1)

                ->maxLength(255)
                ->required(),
            Section::make()->columnSpanFull()->components([
                Text::make('Kérjük, írja le részletesen weboldal-projektjét, maximum 20 000 karakter terjedelemben. Itt lehetősége van megosztani velünk elképzeléseit a weboldal céljával, célközönségével, kívánt hangulatával, preferált színeivel vagy stílusával kapcsolatban, valamint bármilyen egyéb, releváns információt, amely segíthet a projekt megértésében. A weboldal specifikus funkcióit, valamint a nyelvesítési igényeket kérjük, az oldal alján található külön beállítási lehetőségeknél adja meg.'),
                RichEditor::make('project_description')
                    ->placeholder('')
                    ->maxLength(20000)
                    ->columnSpanFull(), ]),

            Toggle::make('have_website_graphic')
                ->columnSpanFull()
                ->default(false)
                ->label('Do you have a website graphic?')

                ->hidden(true)
                ->disabled(),
            Section::make()
                ->heading('Rendelkezik már kész grafikai tervvel vagy látványtervvel (UI) a weboldalához?')
                ->components([
                    /*  Text::make('Rendelkezik már kész grafikai tervvel vagy látványtervvel (UI) a weboldalához?'), */
                    Text::make(Html::make('<h3 class="text-lg font-medium"> Mi is az a grafikai terv / látványterv (UI)? </h3>')),
                    Html::make(null)->content('<p>
        A grafikai terv vagy látványterv (User Interface – UI) a weboldal vizuális megjelenését, elrendezését és
        felhasználói
        felületét mutatja be még a fejlesztés megkezdése előtt. Ez magában foglalja a színsémákat, tipográfiát, képek és
        szövegek elhelyezkedését, gombok stílusát és minden olyan vizuális elemet, amely befolyásolja a felhasználói
        élményt,
        egyfajta "digitális makettként" szolgálva.
    </p>'),
                    /*  ViewField::make('have_website_graphic')->columnSpanFull()
                        ->view('filament.forms.components.have-website-graphic'), */
                ]),

            ToggleButtons::make('have_website_graphic')
                ->label('Do you have a website graphic?')
                ->live()
                ->default(false)
                ->inline()
                ->boolean()
                ->required(),
        ]),
            CheckboxList::make('request_quote_functionalities')

                ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                    return $query->where('website_type_id', $get('website_type_id'))?->notDefault();
                })
                ->getOptionLabelFromRecordUsing(fn (Model $record): string => sprintf('%s', $record->name))
                ->disabled(fn ($get): bool => $get('website_type_id') === null)
                ->descriptions(function (Get $get) {
                    return RequestQuoteFunctionality::whereWebsiteTypeId($get('website_type_id'))->notDefault()->pluck('description', 'id')->toArray();
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
                    return WebsiteLanguage::whereNot('id', '=', $get('default_language'))->pluck('name', 'id');
                })
                ->searchable(),
        ]);
    }

    private function getConstentSchema(): Step
    {
        return Step::make('Consent')->schema([Grid::make(1)->schema([
            TextInput::make('name')
                ->label('Full Name')

                ->live()
                ->required()
                ->maxLength(255)
                ->visible(fn (): bool => ! Auth::check()),
            TextInput::make('email')

                ->email()
                ->live()
                ->required()
                ->maxLength(255)
                ->visible(fn (): bool => ! Auth::check()),
            TextInput::make('phone')

                ->tel()
                ->live()
                ->required()
                ->maxLength(255)
                ->visible(fn (): bool => ! Auth::check()),
            Select::make('client_type')
                ->label('Legal form')

                ->live()
                ->required()
                ->options(ClientType::class)
                ->preload()
                ->visible(fn (): bool => ! Auth::check()),
            TextInput::make('company_name')

                ->visible(fn ($get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                ->required(fn ($get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                ->maxLength(255),
            TextInput::make('company_address')

                ->visible(fn ($get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                ->maxLength(255),
            TextInput::make('company_contact_name')

                ->visible(fn ($get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                ->required(fn ($get): bool => ! Auth::check() && $get('client_type') === ClientType::COMPANY->value)
                ->maxLength(255),
            Checkbox::make('consent')
                ->live()
                ->default(false)
                ->label('I agree to the terms and conditions(note:later has link)')

                ->required()
                ->helperText(__('You must agree to the terms and conditions to proceed.'))
                ->rules(['accepted']),
            Checkbox::make('privacy_policy')
                ->live()
                ->label('I agree to the processing of my personal data in accordance with the privacy policy(note:later has link)')

                ->default(false)
                ->helperText(__('You must agree to the processing of your personal data in accordance with the privacy policy to proceed.'))
                ->required()
                ->rules(['accepted']),
        ]),
        ]);
    }

    /**
     * Get the registration form schema with common fields.
     */
    private function getRegistrationFormSchema(): array
    {
        return [
            Select::make('client_type')

                ->label('Legal form')
                ->live()
                ->required()
                ->options(ClientType::class)
                ->enum(ClientType::class),
            TextInput::make('company_name')

                ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                ->maxLength(255),
            TextInput::make('company_address')

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
                ->unique('users', 'email')
                ->live()
                ->required()
                ->maxLength(255),
            TextInput::make('phone')

                ->tel()
                ->live()
                ->required()
                ->maxLength(255),
            TextInput::make('password')
                ->confirmed()

                ->password()
                ->revealable()
                ->required()
                ->maxLength(255),
            TextInput::make('password_confirmation')

                ->password()
                ->revealable()
                ->required(),
        ];
    }

    private function webshop(): array
    {
        return [
            [
                'name' => 'Főoldal',
                'length' => 'medium',
                'required' => '1',
            ],
            [
                'name' => 'Webshop',
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

        ];

    }

    private function website(): array
    {
        return [
            [
                'name' => 'Főoldal',
                'length' => 'medium',
                'required' => '1',
            ],
            [
                'name' => 'Kapcsolat',
                'length' => 'medium',
                'required' => '1',
            ],
            [
                'name' => 'Termékeink',
                'length' => 'medium',
                'required' => '0',
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
        ];
    }

    private function landingPage(): array
    {
        return [
            [
                'name' => 'Főoldal',
                'length' => 'medium',
                'required' => '1',
            ],
        ];
    }

    private function getWebsiteRepererSchema(): array
    {
        return [
            TextInput::make('name')
                ->disabled(fn ($get): bool => $get('name') === 'Főoldal' || $get('name') === 'Webshop')
                ->live()
                ->required()
                ->distinct(),
            ToggleButtons::make('required')
                ->disabled(fn ($get): bool => $get('name') === 'Főoldal' || $get('name') === 'Webshop')
                ->label('Want to this page?')
                ->live()
                ->grouped()

                ->default('0')
                ->boolean()
                ->colors([
                    'true' => 'success',
                    'false' => 'danger',
                ])
                ->inline()
                ->required(),
            ToggleButtons::make('length')
                ->label('Content length')

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

                ->visible(fn ($get) => $get('required'))
                ->label(__('Page description'))
                ->maxLength(65535)
                ->columnSpanFull(),
            FileUpload::make('images')

                ->label('Adott oldalhoz esetleges igényelt képek feltöltése')
                ->visible(fn ($get) => $get('required'))
                ->image()
                ->multiple()
                ->disk('public')
                ->directory('website-images')
                ->openable()
                ->downloadable()
                ->reorderable()
                ->maxFiles(10)

                ->helperText(__('You can upload multiple images'))
                ->columnSpanFull(),
        ];

    }
}
