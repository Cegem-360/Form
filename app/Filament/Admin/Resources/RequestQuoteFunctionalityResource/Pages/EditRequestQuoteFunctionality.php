<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages;

use App\Filament\Resources\Admin\RequestQuoteFunctionalityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditRequestQuoteFunctionality extends EditRecord
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
