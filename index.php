<?php
include 'App/autoload.php';

$router = new Router();

$router->get('/', function() { echo 'Hello World'; });

$router->run();
?>


