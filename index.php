<?php

// FRONT CONTROLLER

// Общие настройки
ini_set('display_errors',1);
error_reporting(0);

session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
define('LINK', "http://".$_SERVER['SERVER_NAME']);
require_once(ROOT."/components/autoload.php");

// Вызов Router
$router = new router();
$router->run();
