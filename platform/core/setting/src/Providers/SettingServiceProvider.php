<?php

namespace Scoris\Setting\Providers;

use Scoris\Base\Supports\Helper;
use Scoris\Base\Traits\LoadAndPublishDataTrait;
use Scoris\Setting\Facades\SettingFacade;
use Scoris\Setting\Models\Setting as SettingModel;
use Scoris\Setting\Repositories\Caches\SettingCacheDecorator;
use Scoris\Setting\Repositories\Eloquent\SettingRepository;
use Scoris\Setting\Repositories\Interfaces\SettingInterface;
use Scoris\Setting\Supports\SettingsManager;
use Scoris\Setting\Supports\SettingStore;
use Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * This provider is deferred and should be lazy loaded.
     *
     * @var boolean
     */
    protected $defer = true;

    public function register()
    {
        $this->setNamespace('core/setting')
            ->loadAndPublishConfigurations(['general']);

        $this->app->singleton(SettingsManager::class, function (Application $app) {
            return new SettingsManager($app);
        });

        $this->app->bind(SettingStore::class, function (Application $app) {
            return $app->make(SettingsManager::class)->driver();
        });

        AliasLoader::getInstance()->alias('Setting', SettingFacade::class);

        $this->app->bind(SettingInterface::class, function () {
            return new SettingCacheDecorator(
                new SettingRepository(new SettingModel)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->publishAssets();
    }

    /**
     * Which IoC bindings the provider provides.
     *
     * @return array
     */
    public function provides()
    {
        return [
            SettingsManager::class,
            SettingStore::class,
            'setting',
        ];
    }
}
