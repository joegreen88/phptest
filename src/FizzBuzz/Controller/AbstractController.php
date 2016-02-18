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

    protected function setSectionsNav()
    {
        $sectionsRepository = $this->app->container->get('SectionsRepository');
        $sections = $sectionsRepository->findAll();
        $this->tpl->sections = $sections;
    }
}
