<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\IdeaResource\Pages;

use App\Filament\Resources\Admin\IdeaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditIdea extends EditRecord
{
    protected static string $resource = IdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
