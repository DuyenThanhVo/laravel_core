<?php

namespace Scoris\Telegram\Providers;

use Illuminate\Support\ServiceProvider;
use Scoris\Base\Supports\Helper;
use Scoris\Base\Traits\LoadAndPublishDataTrait;
use Event;
use Illuminate\Routing\Events\RouteMatched;
use Scoris\Hello\Models\Hello;

class TelegramServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/telegram')
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadMigrations()
            ->publishAssets();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id' => 'cms-plugins-telegram',
                    'priority' => 5,
                    'parent_id' => null,
                    'name' => 'Telegram',
                    'icon' => 'fab fa-telegram',
                    'url' => null
                ])
                ->registerItem([
                    'id' => 'cms-plugins-telegram-list',
                    'priority' => 5,
                    'parent_id' => 'cms-plugins-telegram',
                    'name' => 'Danh sách tài khoản',
                    'icon' => null,
                    'url' => route('plugins.telegram.index')
                ]);
        });
    }
}
