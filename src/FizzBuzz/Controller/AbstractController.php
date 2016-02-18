<?php

namespace FizzBuzz\Controller;

use FizzBuzz\Renderer;
use Smrtr\SpawnPoint\AbstractController as SpawnAbstractController;

abstract class AbstractController extends SpawnAbstractController
{
    /**
     * @var \FizzBuzz\Renderer
     */
    protected $tpl;

    public function __construct()
    {
        $this->tpl = new Renderer;
    }

    /**
     * @param $url
     * @param bool $external
     */
    protected function redirect($url, $external = false)
    {
        $baseUrl = $this->app->request->getHost();

        $uri = $url;
        if (!$external) {
            $uri = 'location: http://'. $baseUrl .'/'.$url;
        }

        header("location: $uri");
        exit();
    }
}
