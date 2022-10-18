<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use DigitalCreative\CollapsibleResourceManager\Resources\Group;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::style('outbuster-theme', asset('assets/css/style.css'));
        Nova::script('outbuster-theme', asset('assets/js/script.js'));
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
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
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'appdevxxx@gmail.com',
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [

            new CollapsibleResourceManager([

                'navigation' => [

                    TopLevelResource::make([
                        'label' => 'Paramètres',
                        'expanded' => false,
                        'resources' => [
                            \App\Nova\GpCountry::class,
                            \App\Nova\MpArtworkCategory::class,
                            \App\Nova\MpArtworkGenre::class,
                            \App\Nova\MpArtworkTag::class,
                            \App\Nova\MpArtworkCritic::class,
                            \App\Nova\MpArtworkWarning::class,
                        ]
                    ]),

                    TopLevelResource::make([
                        'label' => 'Catalogue',
                        'expanded' => false,
                        'resources' => [
                            \App\Nova\Film::class,
                            \App\Nova\Serie::class,
                        ]
                    ]),

                    TopLevelResource::make([
                        'label' => 'Resources',
                        'expanded' => false,
                        'resources' => [
                            \App\Nova\Plan::class,
                            \App\Nova\Subscription::class,
                            \App\Nova\User::class,
                            \App\Nova\Feedback::class,
                        ]
                    ]),

                ]

            ]),

        ];
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
}
