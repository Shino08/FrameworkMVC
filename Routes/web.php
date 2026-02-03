<?php
declare(strict_types= 1);

use Lib\Route;

Route::get('/', function () {
    echo "Hello World";
});

Route::get("/about", function () {
    echo "About";
});

Route::get("/contact", function () {
    echo "Contact";
});

Route::dispatch();