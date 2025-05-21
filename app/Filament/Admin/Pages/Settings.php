<?php

namespace App\Filament\Admin\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use App\Models\Option;

class Settings extends Page
{
    protected static ?string $model = Option::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    /* protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationParentItem = 'Options'; */

    protected static ?string $navigationLabel = 'Global Options';

     /**
     * @var view-string
     */
    protected static string $view = 'filament.pages.settings';
}
