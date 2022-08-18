<?php

session_start();

require_once("./lib/Router.php");
require_once("./lib/Database.php");

$url = $_SERVER['REQUEST_URI'];
$request = $_REQUEST;
$session = $_SESSION;
$files = $_FILES;

$router = new Router($url, $request, $session, $files);

$router->route();