<?php

namespace Scoris\Contact\Providers;

use Illuminate\Support\ServiceProvider;
use Scoris\Base\Supports\Helper;
use Scoris\Base\Traits\LoadAndPublishDataTrait;
use Event;
use Illuminate\Routing\Events\RouteMatched;
use Scoris\Contact\Models\ContactCategory;
use Scoris\Contact\Repositories\Eloquent\ContactCategoryRepository;
use Scoris\Contact\Repositories\Interfaces\ContactCategoryInterface;
use Scoris\Contact\Models\Contact;
use Scoris\Contact\Repositories\Eloquent\ContactRepository;
use Scoris\Contact\Repositories\Interfaces\ContactInterface;
use Scoris\Contact\Models\UserContact;
use Scoris\Contact\Repositories\Eloquent\UserContactRepository;
use Scoris\Contact\Repositories\Interfaces\UserContactInterface;
use Maatwebsite\Excel\ExcelServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Maatwebsite\Excel\Facades\Excel;

class ContactServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(ContactCategoryInterface::class, function () {
            return new ContactCategoryRepository(new ContactCategory());
        });

        $this->app->bind(ContactInterface::class, function () {
            return new ContactRepository(new Contact());
        });

        $this->app->bind(UserContactInterface::class, function () {
            return new UserContactRepository(new UserContact());
        });
    }

    public function boot()
    {
        $this->setNamespace('plugins/contact')
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web', 'api'])
            ->loadMigrations()
            ->publishAssets();

        $this->app->register(ExcelServiceProvider::class);
        AliasLoader::getInstance()->alias('Excel', Excel::class);
    }
}
