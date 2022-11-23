<?php

include 'helpers.php';
include 'Views/View.php';

spl_autoload_register(function ($name) {
    if (file_exists('App/Controllers/' . $name . '.php')) {
        include 'App/Controllers/' . $name . '.php';
    }

    if (file_exists('App/Router/' . $name . '.php')) {
        include 'App/Router/' . $name . '.php';
    }
});
