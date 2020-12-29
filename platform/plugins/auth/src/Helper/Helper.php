<?php

    namespace Scoris\Auth\Helper;

    class Helper
    {
        public static function code($key)
        {
            return config('plugins.auth.code')[$key];
        }
    }
