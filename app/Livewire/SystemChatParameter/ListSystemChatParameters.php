<?php

declare(strict_types=1);

namespace App\Livewire\SystemChatParameter;

use App\Models\SystemChatParameter;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListSystemChatParameters extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(SystemChatParameter::query())
            ->columns([
                TextColumn::make('form_field_name')->limit(50)
                    ->searchable(),
                TextColumn::make('role'),
            ])
            ->actions([
                ViewAction::make('viewFormContent')
                    ->icon('heroicon-o-eye')
                    ->label(__('filament-actions::view.single.label'))
                    ->form(
                        [
                            Textarea::make('content')
                                ->disabled()
                                ->autosize(),
                        ]
                    ),
                EditAction::make('updateFormContent')
                    ->slideOver()
                    ->closeModalByClickingAway(false)
                    ->icon('heroicon-o-pencil')
                    ->label(__('filament-actions::edit.single.label'))
                    ->using(function (SystemChatParameter $record, array $data, EditAction $action): SystemChatParameter {
                        if (is_null($data['content'])) {

                            Notification::make()
                                ->danger()
                                ->title('Content is required')
                                ->body('Must have content of the form field.')
                                ->persistent()
                                ->send();
                            $action->halt();
                        }

                        $record->update($data);

                        return $record;
                    })
                    ->form([
                        RichEditor::make('content')
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                    ]),
            ], position: ActionsPosition::BeforeColumns);
    }

    public function render(): View
    {
        return view('livewire.system-chat-parameter.list-system-chat-parameters');
    }
}
