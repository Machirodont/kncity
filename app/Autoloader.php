<?php

namespace kncity\app;

class Autoloader
{
    public static function loadClass($class)
    {
        if (substr($class, 0, 7) === "kncity\\") {
            $fileName= __DIR__ . "/../" . substr($class, 7) . ".php";
            require_once $fileName;
        }
    }

    public static function init()
    {
        spl_autoload_register(Autoloader::class."::loadClass");
    }
}