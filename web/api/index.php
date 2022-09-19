<?php

use kncity\app\Autoloader;
use kncity\app\Request;
use kncity\controllers\BaseController;

require __DIR__ . "/../../app/Autoloader.php";
Autoloader::init();

$request = Request::createFromHTTP();
BaseController::run($request);
