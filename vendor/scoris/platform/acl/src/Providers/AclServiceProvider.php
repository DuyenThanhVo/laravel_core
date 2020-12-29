<?php

namespace Scoris\ACL\Providers;

use Illuminate\Support\Facades\Blade;
use Scoris\ACL\Models\Activation;
use Scoris\ACL\Models\Role;
use Scoris\ACL\Models\User;
use Scoris\ACL\Repositories\Caches\RoleCacheDecorator;
use Scoris\ACL\Repositories\Eloquent\ActivationRepository;
use Scoris\ACL\Repositories\Eloquent\RoleRepository;
use Scoris\ACL\Repositories\Eloquent\UserRepository;
use Scoris\ACL\Repositories\Interfaces\ActivationInterface;
use Scoris\ACL\Repositories\Interfaces\RoleInterface;
use Scoris\ACL\Repositories\Interfaces\UserInterface;
use Illuminate\Support\ServiceProvider;
use Scoris\Base\Supports\Helper;
use Scoris\Base\Traits\LoadAndPublishDataTrait;

class AclServiceProvider extends ServiceProvider
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

        $this->app->bind(UserInterface::class, function () {
            return new UserRepository(new User);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setNamespace('core/acl')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->publishAssets()
            ->loadMigrations();
    }
}
