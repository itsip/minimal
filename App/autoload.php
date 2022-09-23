<?php

spl_autoload_register(function($name) {
    if (file_exists('App/Router/' . $name . '.php')) {
        include 'App/Router/' . $name . '.php';
    }
});

?>
