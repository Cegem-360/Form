<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use App\Models\Option;
use Filament\Pages\Page;

final class Settings extends Page
{
    protected static ?string $model = Option::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog';

    /* protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationParentItem = 'Options'; */

    protected static ?string $navigationLabel = 'Global Options';

    /**
     * @var view-string
     */
    protected string $view = 'filament.pages.settings';
}
