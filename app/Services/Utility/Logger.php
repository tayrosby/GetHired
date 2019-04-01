<?php

namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;

class Logger implements ILoggerService
{
    
    public static function debug($message, $data=array())
    {
        Log::debug($message . (count($data) !=0 ? ' with data of ' . print_r($data, true) : ""));
    }
    
    public static function info($message, $data=array())
    {
        Log::debug($message . (count($data) !=0 ? ' with data of ' . print_r($data, true) : ""));
    }
    
    public static function warning($message, $data=array())
    {
        Log::debug($message . (count($data) !=0 ? ' with data of ' . print_r($data, true) : ""));
    }
    
    public static function error($message, $data=array())
    {
        Log::debug($message . (count($data) !=0 ? ' with data of ' . print_r($data, true) : ""));
    }
}
