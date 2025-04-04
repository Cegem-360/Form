<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\ClientType;
use App\Mail\QuotationSendedToUser;
use App\Models\RequestQuote;
use App\Models\User;
use App\Models\WebsiteLanguage;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GuestShowQuaotationForm extends Component implements HasForms
{
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
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Full Name')
                        ->live()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->live()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->live()
                        ->required()
                        ->maxLength(255),
                    Select::make('client_type')
                        ->live()
                        ->required()
                        ->options(ClientType::class)
                        ->preload()
                        ->searchable(),
                    TextInput::make('company_name')
                        ->visible(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->required(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->maxLength(255),
                    TextInput::make('company_address')
                        ->visible(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->required(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->maxLength(255),
                    TextInput::make('company_vat_number')
                        ->visible(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->required(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->maxLength(255),
                    TextInput::make('company_contact_name')
                        ->visible(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->required(fn ($get) => $get('client_type') === ClientType::COMPANY->value)
                        ->maxLength(255),
                    Select::make('website_type_id')
                        ->required()
                        ->live()
                        ->preload(),
                    Select::make('website_engine')
                        ->options([
                            'wordpress' => 'Wordpress',
                            'Laravel' => 'Laravel',
                            'shopify' => 'Shopify',
                        ])->required(),
                ]),
                Grid::make(1)->schema([
                    Repeater::make('websites')->schema([
                        Grid::make(2)->columnSpan(1)->schema([
                            Grid::make(1)->columnSpan(1)->schema([
                                TextInput::make('name')->required(),
                                ToggleButtons::make('length')
                                    ->live()
                                    ->options([
                                        'short' => 'Short',
                                        'medium' => 'Medium',
                                        'long' => 'Long',
                                    ])
                                    ->inline()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $set('image',
                                            match ($state) {
                                                'short' => 'website_previews/short_preview.png',
                                                'medium' => 'website_previews/medium_preview.jpg',
                                                'long' => 'website_previews/long_preview.jpg',
                                                default => 'medium',
                                            });
                                    })
                                    ->required(),

                            ]),
                            Grid::make(1)->columnSpan(1)->schema([
                                ViewField::make('image')
                                    ->view('filament.forms.components.image')
                                    ->viewData(
                                        [
                                            function (Get $get) { // adds the initial state on page load
                                                return $get('image');
                                            },
                                        ]
                                    )
                                    ->formatStateUsing(function (Get $get) {
                                        return match ($get('length')) {
                                            'short' => 'website_previews/short_preview.png',
                                            'medium' => 'website_previews/medium_preview.jpg',
                                            'long' => 'website_previews/long_preview.jpg',
                                            default => 'website_previews/medium_preview.jpg',
                                        };
                                    }),
                            ]),
                        ]),
                    ]),
                ]),
                Grid::make(1)->schema(
                    [
                        Toggle::make('have_website_graphic')
                            ->default(false)
                            ->label('Do you have a website graphic?')
                            ->disabled(),
                        Actions::make([
                            Action::make('yes')
                                ->visible(fn ($get) => $get('have_website_graphic') === false)
                                ->translateLabel()
                                ->requiresConfirmation()
                                ->modalHeading(__('Website graphic'))
                                ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                                ->modalSubmitActionLabel(__('Yes, I have a website graphic'))
                                ->modalCancelActionLabel(__("No, I don't have a website graphic"))
                                ->modalAlignment(Alignment::Center)
                                ->action(function (Set $set) {
                                    $set('have_website_graphic', true);
                                }),
                            Action::make('no')
                                ->visible(fn ($get) => $get('have_website_graphic') === true)
                                ->translateLabel()
                                ->requiresConfirmation()
                                ->modalHeading(__('Website graphic'))
                                ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                                ->modalSubmitActionLabel('No, I don\'t have a website graphic')
                                ->modalAlignment(Alignment::Center)
                                ->action(function (Set $set) {
                                    $set('have_website_graphic', false);
                                }),
                        ])->label('Do you have a website graphic?'),
                    ]),

                Select::make('request_quote_functionalities')->multiple()
                    ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                        return $query->where('website_type_id', $get('website_type_id'));
                    }),
                Toggle::make('is_multilangual'),
                Select::make('languages')
                    ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                    ->multiple()
                    ->preload()->searchable(),
            ])
            ->statePath('data')
            ->model(RequestQuote::class);
    }

    public function submitAndSendEmail(): void
    {
        $data = $this->form->getState();
        $validatedData = $this->validate();
        dump($validatedData);
        $record = RequestQuote::create($data);
        Notification::make()
            ->title('Quotation created and email sent')
            ->success()
            ->send();
        $this->form->model($record)->saveRelationships();

        // TODO - send email with quotation

        Mail::to($data['email'])->send(new QuotationSendedToUser($record));
    }

    public function order(): void
    {
        $data = $this->form->getState();
        $record = RequestQuote::create($data);
        Notification::make()
            ->title('Quotation created and order placed')
            ->success()
            ->send();
        $this->form->model($record)->saveRelationships();
    }

    public function registerAndOrder(): void
    {
        $data = $this->form->getState();

        // user create and login and navigate to guestViewQuotationOrder

        /**
         * TODO - add email verification
         * TODO - add permissions and roles
         * TODO - add email verification
         */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('password'), // or use a random password
        ]);

        event(new Registered($user));
        Auth::loginUsingId($user->id, true);
        $record = RequestQuote::create($data);

        Notification::make()
            ->title('Quotation created and order placed')
            ->success()
            ->send();

        $this->form->model($record)->saveRelationships();

    }

    public function render(): View
    {
        return view('livewire.guest-show-quaotation-form');
    }
}
