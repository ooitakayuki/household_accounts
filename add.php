<?php
require_once __DIR__ . "/vendor/autoload.php";

use Controller\AddController;

$controller = new AddController();
$controller->run();