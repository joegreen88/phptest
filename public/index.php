<?php
/**
 * Web root; index.php.
 *
 * @author Joe Green
 * @package Smrtr\SpawnPoint
 */

// Site paths

require_once __DIR__.'/../paths.php';

// Application environment

if (is_readable(ROOT_PATH.'/.APP_ENV')) {
    define('APP_ENV', trim(file_get_contents(ROOT_PATH.'/.APP_ENV')));
}
else {
    define('APP_ENV', getenv('APP_ENV') ?: 'testing');
}

// Autoloader (requires composer install)

require_once ROOT_PATH.'/vendor/autoload.php';

// Eco-friendly variable scope

$SpawnPoint = function() {

    // Bootstrap the application
    /** @var \Smrtr\SpawnPoint\App $app */
    $app = require_once APP_PATH.'/bootstrap.php';

    // Run the application
    $app->run();

};

// Start process

$SpawnPoint();