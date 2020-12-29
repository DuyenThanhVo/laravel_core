<?php

namespace Scoris\PluginManagement\Providers;

use Scoris\Base\Supports\Helper;
use Scoris\Base\Traits\LoadAndPublishDataTrait;
use Composer\Autoload\ClassLoader;
use Event;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Psr\SimpleCache\InvalidArgumentException;
use Schema;

class PluginManagementServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        $this->setNamespace('packages/plugin-management')
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->publishAssets();

        Helper::autoload(__DIR__ . '/../../helpers');

        if ((check_database_connection() && Schema::hasTable('settings')) || config('core.setting.general.driver') === 'json') {
            $plugins = get_active_plugins();
            if (!empty($plugins) && is_array($plugins)) {
                $loader = new ClassLoader;
                $providers = [];
                $namespaces = [];
                if (cache()->has('plugin_namespaces') && cache()->has('plugin_providers')) {
                    $providers = cache('plugin_providers');
                    if (!is_array($providers) || empty($providers)) {
                        $providers = [];
                    }

                    $namespaces = cache('plugin_namespaces');

                    if (!is_array($namespaces) || empty($namespaces)) {
                        $namespaces = [];
                    }
                }

                if (empty($namespaces) || empty($providers)) {
                    foreach ($plugins as $plugin) {
                        if (empty($plugin)) {
                            continue;
                        }

                        $pluginPath = plugin_path($plugin);

                        if (!File::exists($pluginPath . '/plugin.json')) {
                            continue;
                        }
                        $content = get_file_data($pluginPath . '/plugin.json');
                        if (!empty($content)) {
                            if (Arr::has($content, 'namespace') && !class_exists($content['provider'])) {
                                $namespaces[$plugin] = $content['namespace'];
                            }

                            $providers[] = $content['provider'];
                        }
                    }
                    cache()->forever('plugin_namespaces', $namespaces);
                    cache()->forever('plugin_providers', $providers);
                }

                foreach ($namespaces as $key => $namespace) {
                    $loader->setPsr4($namespace, plugin_path($key . '/src'));
                }

                $loader->register();

                foreach ($providers as $provider) {
                    if (!class_exists($provider)) {
                        continue;
                    }

                    $this->app->register($provider);
                }
            }
        }

        $this->app->register(CommandServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-packages-plugin-management',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'Plugin Management',
                'icon' => 'fas fa-plug',
                'url' => route('plugin-management.index')
            ]);
        });
    }
}
