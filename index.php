<?php
require_once __DIR__ . "/vendor/autoload.php";

use Controller\IndexController;

$controller = new IndexController();
$controller->run();
