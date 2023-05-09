<?php
namespace app\helpers;

class Request
{
    public static function get():string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public static function post():string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public static function put():string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public static function delete():string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}