<?php

namespace Scoris\Base\Providers;

use Botble\Assets\Providers\AssetsServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
use Scoris\Base\Facades\AssetsFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Scoris\Base\Traits\LoadAndPublishDataTrait;
use Scoris\Base\Supports\Helper;
use Event;

class BaseServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->setNamespace('core/base')
            ->loadAndPublishConfigurations(['general']);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setNamespace('core/base')
            ->loadAndPublishConfigurations(['permissions', 'assets'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadMigrations()
            ->publishAssets();

        $this->app->register(AssetsServiceProvider::class);

        AliasLoader::getInstance()->alias('Assets', AssetsFacade::class);
    }
}
