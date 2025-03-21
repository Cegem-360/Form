<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\FormQuestion;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateSmallForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public FormQuestion $post;

    public ?string $token = '';

    /**
     * Undocumented function
     *
     * @param [type] $token
     */
    public function mount($token = null): void
    {
        $this->token = $token;
        $this->post = FormQuestion::whereToken($this->token)->first();
        // dump($this->post);
        if ($this->post === null) {
            $this->redirect(route('form.expired'));
        }

        $this->form->fill($this->post->toArray());

    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Company basic informations')->translateLabel()
                        ->schema([
                            RichEditor::make('formating_milestone')
                                ->maxLength(255)->translateLabel(),
                            RichEditor::make('visual_fealing')
                                ->maxLength(255)->translateLabel(),

                        ]),
                    Step::make('Theme')->translateLabel()
                        ->schema([
                            Toggle::make('have_exist_design')->translateLabel()->live(),
                            FileUpload::make('design_files')->translateLabel()->multiple()->visible(fn (Get $get) => $get('have_exist_design')),
                            Repeater::make('inspire_websites')->schema([
                                TextInput::make('name')
                                    ->maxLength(255)->translateLabel(),
                            ])->translateLabel(),
                            RichEditor::make('banned_elements')->translateLabel(),
                            ColorPicker::make('primary_color')
                                ->translateLabel(),
                            ColorPicker::make('secondary_color')
                                ->translateLabel(),
                            Repeater::make('additional_colors')->schema([
                                ColorPicker::make('color')->translateLabel(),
                            ])->translateLabel(),
                            Repeater::make('font_type_name')->schema([
                                TextInput::make('font')
                                    ->maxLength(255)->translateLabel(),
                            ])->translateLabel(),
                        ]),
                    Step::make('Design files')->translateLabel()
                        ->schema([
                            FileUpload::make('own_company_images')
                                ->multiple()->translateLabel(),
                            Toggle::make('use_video_or_animation')
                                ->translateLabel(),
                            Toggle::make('have_product_catalog')->translateLabel()->live(),
                            FileUpload::make('product_catalog')->translateLabel()->multiple()->visible(fn (Get $get) => $get('have_product_catalog')),

                        ]),
                    Step::make('Website page basics start')->translateLabel()
                        ->schema([
                            Repeater::make('main_pages')->schema([
                                TextInput::make('name')
                                    ->maxLength(255)->translateLabel(),
                                RichEditor::make('description')->translateLabel(),
                            ])->translateLabel()->deletable(false)->addable(false)->reorderable(false)->defaultItems(3),
                            RichEditor::make('tone_of_website')
                                ->maxLength(255)->translateLabel(),
                            RichEditor::make('other_tone_of_website')
                                ->maxLength(255)->translateLabel(),
                            RichEditor::make('call_to_actions')->translateLabel(),
                            RichEditor::make('other_expectation_or_request')
                                ->columnSpanFull()->translateLabel(),
                        ]),
                ])->skippable(),
            ])
            ->statePath('data')->model($this->post);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = FormQuestion::whereToken($this->token)->first();
        $record->update($data);
        $record->update(['token' => null]);

        $this->form->model($record)->saveRelationships();

        Notification::make('Form submitted successfully!')->title('Form submitted successfully!')->success()->send();
        // ProcessFormSubmission::dispatch($record->id);

        $this->redirect(route('form.review', ['form' => $record->id]));
    }

    public function saveAsDraft(): void
    {
        $data = $this->form->getState();

        $record = FormQuestion::whereToken($this->token)->first();
        $record->update($data);

        $this->form->model($record)->saveRelationships();
        Notification::make('Form saved successfully!')->title('Form saved successfully!')->success()->send();
        $this->redirect(route('form.review', ['form' => $record->id]));
    }

    public function render(): View
    {
        return view('livewire.create-small-form');
    }
}
