<?php

namespace kncity\app;

class Request
{
    /**
     * @var string
     */
    public $controllerClass;

    /**
     * @var string
     */
    public $action;

    /**
     * @var array
     */
    private $_get;

    /**
     * @var array
     */
    private $_post;

    public function get(string $key)
    {
        return array_key_exists($key, $this->_get)
            ? $this->_get[$key]
            : null;
    }

    public function post(string $key)
    {
        return array_key_exists($key, $this->_post)
            ? $this->_post[$key]
            : null;
    }

    public static function createFromHTTP(): self
    {
        $r = new self();
        $r->_get = $_GET;
        $r->_post = $_POST;
        $r->action = strtolower($_SERVER["REQUEST_METHOD"]);
        $r->controllerClass = self::urlToController($_SERVER["REQUEST_URI"]);
        return $r;
    }

    private static function urlToController(string $url): string
    {
        $path = trim(parse_url($url, PHP_URL_PATH), "/");
        $route = explode("/", $path);
        if ($route[0] !== "api" || count($route) < 2) {
            return "";
        }
        $route = array_slice($route, 1);
        $route[count($route) - 1] = ucfirst($route[count($route) - 1]);
        $controllerClass = "kncity\\controllers\\" . implode("\\", $route) . "Controller";
        return $controllerClass;
    }
}