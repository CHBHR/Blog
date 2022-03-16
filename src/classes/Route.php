<?php

declare(strict_types=1);

class Route
{

    public static $validRoutes = array();

    public static function set($route, $fucntion)
    {
        self::$validRoutes[] = $route;

        
    }
}