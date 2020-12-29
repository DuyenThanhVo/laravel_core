<?php

use Illuminate\Support\Facades\DB;
use Scoris\Base\Facades\DashboardMenuFacade;
use Scoris\Base\Facades\PageTitleFacade;
use Scoris\Base\Supports\DashboardMenu;

if (!function_exists('platform_path')) {
    /**
     * @return string
     */
    function platform_path($path = null): string
    {
        return base_path('platform/' . $path);
    }
}

if (!function_exists('check_database_connection')) {
    /**
     * @return boolean
     */
    function check_database_connection(): bool
    {
        try {
            DB::connection(config('database.default'))->reconnect();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}

if (!function_exists('page_title')) {
    /**
     * @return PageTitle
     */
    function page_title()
    {
        return PageTitleFacade::getFacadeRoot();
    }
}

if (!function_exists('dashboard_menu')) {
    /**
     * @return \Scoris\Base\Supports\DashboardMenu
     */
    function dashboard_menu()
    {
        return DashboardMenuFacade::getFacadeRoot();
    }
}
