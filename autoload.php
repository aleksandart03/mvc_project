<?php

spl_autoload_register(function ($class) {
    $path = __DIR__ . '/app/controllers/' . $class . '.php';
    if (file_exists($path)) {
        require_once $path;
        return;
    }

    $path = __DIR__ . '/app/models/' . $class . '.php';
    if (file_exists($path)) {
        require_once $path;
        return;
    }
});
