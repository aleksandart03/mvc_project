<?php

spl_autoload_register(function ($class) {
    $paths = [
        'app/controllers/',
        'app/models/',
    ];

    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';
        if (file_exists($file)) {
            include $file;
            return;
        }
    }
});
