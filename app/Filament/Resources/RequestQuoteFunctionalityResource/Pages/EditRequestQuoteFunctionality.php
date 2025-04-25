<?php

declare(strict_types=1);

namespace App\Filament\Resources\RequestQuoteFunctionalityResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\RequestQuoteFunctionalityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestQuoteFunctionality extends EditRecord
{
    protected static string $resource = RequestQuoteFunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
