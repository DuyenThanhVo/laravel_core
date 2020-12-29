<?php

namespace Scoris\Example\Providers;

use Illuminate\Support\ServiceProvider;
use Scoris\Base\Traits\LoadAndPublishDataTrait;
use Scoris\Base\Supports\Helper;
use Illuminate\Support\Facades\Event;
use Illuminate\Routing\Events\RouteMatched;
use Scoris\Example\Http\Middleware\ExampleMustStartWithLetterA;
use Scoris\Example\Models\Example;
use Scoris\Example\Repositories\Eloquent\ExampleRepository;
use Scoris\Example\Repositories\Interfaces\ExampleInterface;

class ExampleServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $router = $this->app['router'];

        $router->aliasMiddleware('example-must-start-with-letter-a', ExampleMustStartWithLetterA::class);

        $this->app->bind(ExampleInterface::class, function () {
            return new ExampleRepository(new Example());
        });
    }

    public function boot()
    {
        $this->setNamespace('plugins/example')
            ->loadAndPublishViews()
            ->loadAndPublishConfigurations(['example'])
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadMigrations()
            ->publishAssets();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id' => 'cms-plugins-example',
                    'priority' => 5,
                    'parent_id' => null,
                    'name' => __('plugins/example::example.text'),
                    'icon' => 'la la-user',
                    'url' => route('example')
                ]);
        });

    }
}
