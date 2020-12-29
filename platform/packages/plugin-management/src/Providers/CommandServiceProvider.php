<?php

namespace Scoris\PluginManagement\Providers;

use Scoris\PluginManagement\Commands\PluginActivateCommand;
use Scoris\PluginManagement\Commands\PluginAssetsPublishCommand;
use Scoris\PluginManagement\Commands\PluginDeactivateCommand;
use Scoris\PluginManagement\Commands\PluginRemoveCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PluginAssetsPublishCommand::class,
            ]);
        }

        $this->commands([
            PluginActivateCommand::class,
            PluginDeactivateCommand::class,
            PluginRemoveCommand::class,
        ]);
    }
}
