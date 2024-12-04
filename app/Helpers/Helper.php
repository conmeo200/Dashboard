<?php

use Illuminate\Support\Facades\Log;

if (!function_exists('LogError')) {
    function LogError($action, $messages, $line, $file)
    {
        Log::error("API File : {$file}, Action : {$action}, Line : {$line}, Error : {$messages}");
    }
}

if (!function_exists('findFirstValueArray')) {
    function findFirstValueArray($arrays, $key_search, $value_search)
    {
        if (empty($arrays) || empty($key_search) || empty($value_search)) return [];

        $result = array_filter($arrays, function($item) use ($key_search, $value_search) {
            return $item[$key_search] == $value_search;
        });

        return $result ? $result : [];
    }
}
