<?php
session_start();

$controller = $_GET['controller'] ?? 'LoginController';
$action     = $_GET['action'] ?? 'index';

$controllerFile = __DIR__ . "/app/controllers/$controller.php";

// DEBUG & KEAMANAN
if (!file_exists($controllerFile)) {
    die("Controller tidak ditemukan di: " . $controllerFile);
}

require_once $controllerFile;

if (!class_exists($controller)) {
    die("Class $controller tidak ditemukan");
}

$obj = new $controller();

if (!method_exists($obj, $action)) {
    die("Method $action tidak ditemukan");
}

$obj->$action();
