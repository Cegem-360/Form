<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\FormQuestionStatus;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\FormQuestion as SchemasFormQuestion;
use App\Models\FormQuestion;
use App\Models\FormQuestionVisibility;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class FormQuestionForm extends Component implements /* HasActions, */ HasSchemas
{
    /* use InteractsWithActions; */
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount()
    {
        /* $this->token = $token;
        $formQuestion = FormQuestion::whereToken($token)->first();
        $this->formQuestionId = $formQuestion?->id;
        if (! $formQuestion instanceof FormQuestion) {
            $this->redirect(route('form.expired'));
        } */
        $this->form->fill();
        /* $this->form->fill($formQuestion->attributesToArray()); */
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('company_name')
                ->columnSpan(1)
                ->maxLength(255),
        ]);
        /* $visibility = FormQuestionVisibility::where('form_question_id', $this->formQuestionId)->first();

        return SchemasFormQuestion::configure($schema, $visibility, $this->data)->statePath('data')
            ->model(FormQuestion::class); */
    }

    /*  public function updateAndCloseAction(): Action
     {

         return Action::make('updateAndClose')
             ->action(function () {
                 $data = $this->form->getState();
                 $data['status'] = FormQuestionStatus::SUBMITTED;
                 $record = FormQuestion::update($data);

                 Notification::make()
                     ->title('Form question updated successfully')
                     ->success()
                     ->icon('heroicon-o-check-circle')
                     ->send();
                 $this->redirect(route('filament.dashboard.resources.form-questions.view', ['record' => $record]));
             });

     } */

    /* public function updateAndDraftAction(): Action
    {

        return Action::make('updateAndDraft')
            ->action(function () {
                $data = $this->form->getState();
                $data['status'] = FormQuestionStatus::TEMPORARILY_SAVED;
                $this->post->update($data);
                Notification::make()
                    ->title('Form question saved as draft')
                    ->success()
                    ->icon('heroicon-o-check-circle')
                    ->send();
            });
    } */

    public function render(): View
    {
        return view('livewire.form-question-form');
    }
}
