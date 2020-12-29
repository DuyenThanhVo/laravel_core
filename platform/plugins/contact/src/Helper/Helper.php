<?php

    namespace Scoris\Contact\Helper;

    class Helper
    {
        public static function code($key)
        {
            return config('plugins.contact.code')[$key];
        }
    }
