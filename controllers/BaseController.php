<?php

namespace kncity\controllers;

use kncity\app\DB;
use kncity\app\Request;
use kncity\app\User;
use kncity\repo\UserRepository;

/**
 * @property User $user
 */
class BaseController
{
    /**
     * @var User
     */
    public $user = null;

    /**
     * @var DB
     */
    public $db;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    public function __construct()
    {
        $config = include __DIR__ . "/../config/config.php";

        $this->db = new DB(
            $config["db"]["hostname"],
            $config["db"]["username"],
            $config["db"]["password"],
            $config["db"]["database"]
        );

        $this->userRepo = new UserRepository($this->db);
    }

    public function __call(string $name, array $arguments)
    {
        header('HTTP/1.1 403 Forbidden');
    }

    public static function run(Request $request)
    {
        /**@var BaseController $controller */
        $controller = new $request->controllerClass();
        if ($authToken = $request->get("auth_token")) {
            $controller->user = $controller->userRepo->findByAuthToken($authToken);
        }

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($controller->{$request->action}($request));
    }

}