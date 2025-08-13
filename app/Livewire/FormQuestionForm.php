<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\FormQuestionStatus;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\FormQuestion as SchemasFormQuestion;
use App\Models\FormQuestion;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
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

        return SchemasFormQuestion::configure($schema, $visibility, $this->data);
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
