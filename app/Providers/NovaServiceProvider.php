<?php

namespace App\Providers;

use App\Nova\Brand;
use App\Nova\Dashboards\Main;
use http\Env\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        $this->getCustomMenu();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function getCustomMenu(): void
    {
        Nova::mainMenu(function (){
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),
                MenuSection::resource(Brand::class)->icon('tag'),

                MenuSection::make('Products', [
                    MenuItem::make('All Products', '/resources/products'),
                    MenuItem::make('Create Products', '/resources/products/new'),
                ])->icon('shopping-bag')->collapsable(),

                MenuSection::make('Users', [
                    MenuItem::make('All Users', '/resources/users'),
                    MenuItem::make('Create User', '/resources/users/new'),
                ])->icon('users')->collapsable(),
            ];
        });
    }
}
