<?php

namespace Scoris\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Scoris\Base\Supports\Helper;
use Scoris\Base\Traits\LoadAndPublishDataTrait;
use Event;
use Illuminate\Routing\Events\RouteMatched;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Tymon\JWTAuth\Http\Middleware\Authenticate;
use Scoris\Auth\Models\User;
use Scoris\Auth\Repositories\Eloquent\AuthRepository;
use Scoris\Auth\Repositories\Interfaces\AuthInterface;

class AuthServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $router = $this->app['router'];

        $router->aliasMiddleware('auth.jwt', Authenticate::class);

        $this->app->bind(AuthInterface::class, function () {
            return new AuthRepository(new User());
        });
    }

    public function boot()
    {
        $this->setNamespace('plugins/auth')
            ->loadAndPublishConfigurations(['code'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web', 'api'])
            ->loadMigrations()
            ->publishAssets();

        $this->app->register(LaravelServiceProvider::class);
    }
}

