<?php
include 'App/autoload.php';

$router = new Router();

$router->get('/', 'ExampleController::index');

$router->run();
?>
