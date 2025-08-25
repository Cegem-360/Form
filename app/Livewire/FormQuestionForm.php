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
            $this->redirect(route('form.expired'), navigate: true);

            return;
        }

        $this->form->fill($this->post->attributesToArray());

    }

    public function form(Schema $schema): Schema
    {
        $visibility = $this->post->visibility()->first();

        return SchemasFormQuestion::configure($schema, $visibility)
            ->statePath('data')
            ->model($this->post);
    }

    public function updateAndCloseAction(): Action
    {
        return Action::make('updateAndCloseAction')
            ->label('Submit and Close')
            ->action(function () {
                $data = $this->form->getState();
                $data['status'] = FormQuestionStatus::SUBMITTED;
                unset($data['consent'],$data['privacy_policy'],$data['consent_start']);
                $this->post->update($data);
                $this->form->saveRelationships();

                Notification::make()
                    ->title(__('Submission successful'))
                    ->success()
                    ->icon('heroicon-o-check-circle')
                    ->send();

                return $this->redirect(
                    route('filament.admin.resources.form-questions.view', ['record' => $this->post->getKey()]),
                );
            });
    }

    public function updateAndDraftAction(): Action
    {
        return Action::make('updateAndDraftAction')
            ->label('Save as Draft')
            ->action(function () {
                $data = $this->form->getState();
                $data['status'] = FormQuestionStatus::TEMPORARILY_SAVED;
                unset($data['consent'],$data['privacy_policy'],$data['consent_start']);
                $this->post->update($data);
                $this->form->saveRelationships();

                Notification::make()
                    ->title(__('Save successful'))
                    ->success()
                    ->icon('heroicon-o-check-circle')
                    ->send();

                return $this->redirect(
                    route('filament.admin.resources.form-questions.view', ['record' => $this->post->getKey()]),

                );
            });
    }

    public function render(): View
    {
        return view('livewire.form-question-form');
    }
}
