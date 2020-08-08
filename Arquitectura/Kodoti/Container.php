<?php
namespace Kodoti;
//Sirve para mantener organizadas las dependencias que se vayan a utilizar.
class Container{
    private static $dependencias = [];

    public static function set(string $key, $func)
    {
        self::$dependencias[$key] = $func;
    }

    public static function get(string $key)
    {
        return self::$dependencias[$key]();
    }
}