<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Dashboard\Pages\Auth\EditProfile;
use App\Filament\Dashboard\Pages\Auth\Login;
use App\Filament\Dashboard\Pages\Dashboard;
use App\Filament\Dashboard\Widgets\DashboardUser;
use App\Filament\Dashboard\Widgets\RequestQuoteFormChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

final class DashboardPanelServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->authGuard('web')
            ->login(Login::class)
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile(EditProfile::class, false)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->brandLogo(fn () => view('filament.dashboard.logo'))
            ->discoverResources(in: app_path('Filament/Dashboard/Resources'), for: 'App\\Filament\\Dashboard\\Resources')
            ->discoverPages(in: app_path('Filament/Dashboard/Pages'), for: 'App\\Filament\\Dashboard\\Pages')
            ->discoverClusters(in: app_path('Filament/Dashboard/Clusters'), for: 'App\\Filament\\Dashboard\\Clusters')
            ->pages([
                Dashboard::class,
            ])
            ->navigationGroups([

            ])
            ->discoverWidgets(in: app_path('Filament/Dashboard/Widgets'), for: 'App\\Filament\\Dashboard\\Widgets')
            ->widgets([
                AccountWidget::class,
                RequestQuoteFormChart::class,
                DashboardUser::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->spa()
            ->viteTheme('resources/css/filament/admin/theme.css');
    }
}
