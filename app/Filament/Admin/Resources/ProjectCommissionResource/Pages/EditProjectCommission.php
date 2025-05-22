<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectCommissionResource\Pages;

use App\Filament\Admin\Resources\ProjectCommissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditProjectCommission extends EditRecord
{
    protected static string $resource = ProjectCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
