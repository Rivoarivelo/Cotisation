<?php
session_start();
require_once __DIR__ . '/../src/config/database.php';
define('BASE_URL', '/cotisation/public/');

$controller = $_GET['controller'] ?? 'dashboard';
$action     = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controller) . 'Controller';
$controllerFile  = __DIR__ . '/../src/controllers/' . $controllerClass . '.php';

if (!file_exists($controllerFile)) {
    die('Controller introuvable');
}

require_once $controllerFile;

$ctrl = new $controllerClass();

if (!method_exists($ctrl, $action)) {
    die('Action introuvable');
}

$ctrl->$action();