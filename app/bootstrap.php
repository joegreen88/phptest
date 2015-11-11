<?php

/**
 * app_path; bootstrap.php
 *
 * @package Smrtr\SpawnPoint
 * @author Joe Green
 */

// Apply php settings

$phpSettings = new \Zend_Config_Ini(
    APP_PATH.'/config/phpSettings.ini',
    APP_ENV,
    ['nestSeparator' => ':']
);

foreach ($phpSettings->toArray() as $key => $value) {
    ini_set($key, $value);
}

// Create router

$router = new \Smrtr\HaltoRouter;

// Add hostgroups

$hostGroups = new \Zend_Config_Ini(APP_PATH.'/config/hostgroups.ini', APP_ENV);

foreach ($hostGroups->toArray() as $hostGroup => $hostnames) {
    $router->addHostnames($hostnames, $hostGroup);
}

// Add routes

$routesConfig = new \Zend_Config_Ini(APP_PATH.'/config/routes.ini', APP_ENV);

foreach ($routesConfig->toArray() as $name => $route) {
    $router->map($route['method'], $route['route'], $route['target'], $name, $route['hostgroup']);
}

// Create app

$app = \Smrtr\SpawnPoint\App::getInstance();

// Register router

$app->router = $router;

// Register request

$app->request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

// Register response

$app->response = \Symfony\Component\HttpFoundation\Response::create();

// Register Dependency Injection Container

$app->container = require_once __DIR__.'/services.php';

// Register error handler

$app->errorHandler = require_once __DIR__.'/error.php';

// Return App

return $app;
