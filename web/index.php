<?php
require_once '../app/config/autoload.php';          // Автоподключение классов и контролеров
include_once '../app/lib/Dev.php';                  //  Подключение библиотек

$router = new Router();
Session::open();
$router->run();

