<?php

use Scoris\Auth\Helper\Helper;

// Return code in config.php key code
if (!function_exists('code')) {
    function code($key)
    {
        return Helper::code($key);
    }
}

if (!function_exists('convert_query')) {
    function convert_query($parameters)
    {
        $params = [];
        foreach ($parameters as $name => $param) {
            if ($param instanceof \Illuminate\Http\UploadedFile) {
                $params[] = [
                    'name' => $name,
                    'contents' => $param->get(),
                    'filename' => $param->getClientOriginalName()
                ];
            }
        }
        return $params;
    }
}


// Get param from route
if (!function_exists('param')) {
    function param($param)
    {
        return \Request::route($param);
    }
}

//clean code
function xss_cleaner($input_str) {
    $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
    $return_str = str_ireplace( '%3Cscript', '', $return_str );
    return $return_str;
}
