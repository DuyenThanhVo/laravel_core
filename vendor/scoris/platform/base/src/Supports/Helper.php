<?php
namespace Scoris\Base\Supports;

use File;

class Helper {
    public static function autoload($directory) {
        $helpers = File::glob($directory . '/*.php');

        foreach ($helpers as $helper) {
            File::requireOnce($helper);
        }
    }

    /**
     * @param $plugin
     *
     * @return boolean
     * @since 3.3
     */
    public static function removePluginData($plugin)
    {
        $folders = [
            public_path('vendor/core/plugins/' . $plugin),
            resource_path('assets/plugins/' . $plugin),
            resource_path('views/vendor/plugins/' . $plugin),
            resource_path('lang/vendor/plugins/' . $plugin),
            config_path('plugins/' . $plugin),
        ];

        foreach ($folders as $folder) {
            if (File::isDirectory($folder)) {
                File::deleteDirectory($folder);
            }
        }

        return true;
    }
}
