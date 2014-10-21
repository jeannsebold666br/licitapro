<?php
header("Content-type: text/html; charset=utf8");
require_once('../config/conf.php');
require_once('../vendor/AutoLoader.php');

$loader = new AutoLoader();
$loader->register();

$app = new Application();
$app->run();