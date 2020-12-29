<?php

namespace Scoris\Example;

use Scoris\PluginManagement\Abstracts\PluginOperationAbstract;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Plugin extends PluginOperationAbstract
{
    public static function activate()
    {
        // Running when plugin activate
    }

    public static function deactivate()
    {
        // Running when plugin deactivate
    }

    public static function remove()
    {
        // Running when plugin remove
    }
}
