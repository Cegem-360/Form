<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Support\Facades\FilamentIcon;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Illuminate\Contracts\Support\Htmlable;

final class Dashboard extends Page
{
    protected static string $routePath = '/';

    protected static ?int $navigationSort = -2;

    /**
     * @var view-string
     */
    protected string $view = 'filament.pages.dashboard';

    public static function getNavigationLabel(): string
    {
        return self::$navigationLabel ??
            self::$title ??
            __('filament-panels::pages/dashboard.title');
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return self::$navigationIcon
            ?? FilamentIcon::resolve('panels::pages.dashboard.navigation-item')
            ?? (Filament::hasTopNavigation() ? 'heroicon-m-home' : 'heroicon-o-home');
    }

    public static function getRoutePath(Panel $panel): string
    {
        return self::$routePath;
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return Filament::getWidgets();
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getVisibleWidgets(): array
    {
        return $this->filterVisibleWidgets($this->getWidgets());
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int|string|array
    {
        return 2;
    }

    public function getTitle(): string|Htmlable
    {
        return __('Filament/pages/dashboard.title');
    }
}
