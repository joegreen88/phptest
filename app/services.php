<?php
// Inversion of Control: Register services to the dependency injection container

$container = new \League\Container\Container;

$container->share('ArticlesRepository', '\FizzBuzz\Service\ArticlesRepository');
$container->share('SectionsRepository', '\FizzBuzz\Service\SectionsRepository');

$container->share('Renderer', function() use ($container) {
	$tpl = new \FizzBuzz\Renderer();
	$tpl->container = $container;
	return $tpl;
});

$container->share('Menu', function() use ($container){
	$menu = new \FizzBuzz\Service\Menu( $container );

	return $menu;
});

$container->share('Router', function() use ($router){
	return $router;
});

return $container;
