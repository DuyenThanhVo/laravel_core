<?php

namespace Scoris\Base\Facades;

use Scoris\Base\Supports\PageTitle;
use Illuminate\Support\Facades\Facade;

class PageTitleFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PageTitle::class;
    }
}
