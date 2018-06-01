<?php
require_once __DIR__ . "/vendor/autoload.php";

use Controllers\IndexController;

$controller = new IndexController();
$controller->run();
