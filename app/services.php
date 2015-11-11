<?php
// Inversion of Control: Register services to the dependency injection container

$container = new \League\Container\Container;

$container->share('ArticlesRepository', '\FizzBuzz\Service\ArticlesRepository');
$container->share('SectionsRepository', '\FizzBuzz\Service\SectionsRepository');

return $container;
