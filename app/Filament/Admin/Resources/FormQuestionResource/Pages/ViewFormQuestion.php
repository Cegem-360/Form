<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Pages;

use App\Filament\Admin\Resources\FormQuestionResource;
use App\Models\FormQuestion;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;

final class ViewFormQuestion extends ViewRecord
{
    protected static string $resource = FormQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view')
                ->label(__('View'))
                ->icon('heroicon-o-eye')
                ->url(function (FormQuestion $record): string {
                    $token = Str::random(60);
                    if ($record->token === null) {
                        $record->token = $token;
                    }

                    if ($record->token !== null) {
                        $token = $record->token;
                    }

                    $record->save();

                    return route('kerdoiv', ['token' => $token]);

                }, true),
            EditAction::make(),
            CreateAction::make(),
        ];
    }
}
