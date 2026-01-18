<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use WallaceMartinss\FilamentEvolution\FilamentEvolutionPlugin;
use MWGuerra\FileManager\FileManagerPlugin;
use TomatoPHP\FilamentTranslations\FilamentTranslationsPlugin;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Filament\View\PanelsRenderHook;
use \App\Http\Middleware\SetLocaleMiddleware;
class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_AFTER,
            fn (): string => Blade::render('
                <div class="flex items-center px-3">
                    @if(app()->getLocale() === \'en\')
                        <a href="{{ route(\'lang.switch\', [\'locale\' => \'ar\']) }}" title="العربية" class="hover:scale-110 transition-transform">
                            <img src="https://flagcdn.com/w40/eg.png" width="32" alt="العربية" class="rounded shadow-sm">
                        </a>
                    @else
                        <a href="{{ route(\'lang.switch\', [\'locale\' => \'en\']) }}" title="English" class="hover:scale-110 transition-transform">
                            <img src="https://flagcdn.com/w40/gb.png" width="32" alt="English" class="rounded shadow-sm">
                        </a>
                    @endif
                </div>
            '),
        );
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
                SetLocaleMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            // ->resourceCreatePageRedirect('index') 
            ->plugins([
                FilamentTranslationsPlugin::make(),
        ]);
    }
}
