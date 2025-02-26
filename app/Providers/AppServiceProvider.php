<?php

namespace App\Providers;

use Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\Admin\RoleRepositoryInterface::class,
            \App\Repositories\Admin\RoleRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text' => 'Financeiro',
                'url' => request()->segment(1) . '/financial',
                'icon' => 'fas fa-fw fa-dollar-sign',
            ]);
            $event->menu->add([
                'text' => 'Minha conta',
                'url' => request()->segment(1) . '/configuration',
                'icon' => 'fas fa-fw fa-user',
            ]);

            $event->menu->add([
                'text' => 'Relatórios',
                'url' => request()->segment(1) . '/reports',
                'icon' => 'fas fa-fw fa-chart-bar',
            ]);
            $event->menu->add([
                'text' => 'Configurações',
                'url' => request()->segment(1) . '/configuration',
                'icon' => 'fas fa-fw fa-cogs',
            ]);
            $event->menu->add([
                'text' => 'Pacientes',
                'url' => request()->segment(1) . '/patients',
                'icon' => 'fas fa-fw fa-user-injured',
            ]);
            $event->menu->add([
                'text' => 'Agenda',
                'url' => request()->segment(1) . '/agenda',
                'icon' => 'fas fa-fw fa-calendar-alt',
            ]);
            $event->menu->add([
                'text' => 'Configurações',
                'url' => request()->segment(1) . '/configuration',
                'icon' => 'fas fa-fw fa-cogs',
            ]);
            $event->menu->add([
                'text' => 'Sair',
                'url' => request()->segment(1) . '/logout',
                'icon' => 'fas fa-fw fa-sign-out-alt',
            ]);
        });
    }
}
