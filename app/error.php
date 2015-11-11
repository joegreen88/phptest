<?php

// Error handler function
return function (\Exception $e, \Smrtr\SpawnPoint\App $app)
{
    static $subDispatch = false;

    if (!$subDispatch && 404 === $e->getCode()) {

        $subDispatch = true;
        
        $app->dispatch([
            'params' => [
                'originalController' => $app->request->attributes->get('controller'),
                'originalAction' => $app->request->attributes->get('action')
            ],
            'target' => '\FizzBuzz\Controller\Homepage@handle404'
        ]);

    } else {

        $app->response->setStatusCode(500);

        if (ini_get('display_errors')) {
            echo $e->getMessage();
        }
    }
};
