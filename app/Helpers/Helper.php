<?php

use Illuminate\Support\Facades\Log;

if (!function_exists('LogError')) {
    function LogError($action, $messages, $line, $file)
    {
        Log::error("API File : {$file}, Action : {$action}, Line : {$line}, Error : {$messages}");
    }
}
