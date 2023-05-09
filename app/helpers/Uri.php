<?php
namespace app\helpers;

class Uri
{
    public static function get(string $type):string
    {
        return parse_url($_SERVER['REQUEST_URI'])[$type];
    }
    public static function post(string $type):string
    {
        return parse_url($_SERVER['REQUEST_URI'])[$type];
    }
    public static function put(string $type):string
    {
        return parse_url($_SERVER['REQUEST_URI'])[$type];
    }
    public static function delete(string $type):string
    {
        return parse_url($_SERVER['REQUEST_URI'])[$type];
    }
}