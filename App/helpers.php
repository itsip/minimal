<?php

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function active($url)
{
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $path = rtrim($path, '/\\');

    return $path === $url;
}

function debug($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function dd($value)
{
    debug($value);
    die();
}
