<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\FormQuestionStatus;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\FormQuestion as SchemasFormQuestion;
use App\Models\FormQuestion;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class FormQuestionForm extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

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

        $this->form->fill($this->post->attributesToArray());

    }

    public function form(Schema $schema): Schema
    {
        $visibility = $this->post->visibility()->first();

        return SchemasFormQuestion::configure($schema, $visibility, $this->data)->statePath('data');
    }

    public function updateAndCloseAction(): Action
    {
        return Action::make('update_and_close')
            ->label('Submit and Close')
            ->action(function () {
                $data = $this->form->getState();
                $data['status'] = FormQuestionStatus::SUBMITTED;

                $this->post->update($data);
                $this->form->saveRelationships();

                Notification::make()
                    ->title('Submission successful')
                    ->success()
                    ->icon('heroicon-o-check-circle')
                    ->send();

                return $this->redirect(route('filament.dashboard.resources.form-questions.view', ['record' => $this->post->getKey()]));
            });
    }

    public function updateAndDraftAction(): Action
    {
        return Action::make('update_and_draft')
            ->label('Save as Draft')
            ->action(function () {
                $data = $this->form->getState();
                dd($data);
                $this->post->update($data);
                $data['status'] = FormQuestionStatus::TEMPORARILY_SAVED;
                $this->form->saveRelationships();

                Notification::make()
                    ->title('Save successful')
                    ->success()
                    ->icon('heroicon-o-check-circle')
                    ->send();
            });
    }

    public function render(): View
    {
        return view('livewire.form-question-form');
    }
}
