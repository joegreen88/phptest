<?php

/**
 * Define common site paths used by the application.
 *
 * @package Smrtr\SpawnPoint
 * @author Joe Green
 */

// Everything is relative to the application root now.
define('ROOT_PATH', realpath(__DIR__));
chdir(ROOT_PATH);

// Common path definitions, these are required
define('PUBLIC_PATH', ROOT_PATH.'/public');
define('APP_PATH', ROOT_PATH.'/app');
define('TEMPLATE_PATH', APP_PATH.'/templates');
