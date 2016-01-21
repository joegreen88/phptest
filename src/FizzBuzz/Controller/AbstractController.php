<?php

namespace FizzBuzz\Controller;

use FizzBuzz\Renderer;
use Smrtr\SpawnPoint\AbstractController as SpawnAbstractController;
use Smrtr\SpawnPoint\App;

abstract class AbstractController extends SpawnAbstractController
{
    /**
     * @var \FizzBuzz\Renderer
     */
    protected $tpl;

    public function __construct()
    {
        //$this->tpl = new Renderer;
    }

    //Litle trick to get Renderer as a service by default without modify vendor Smrtr
    //I would use a Symfony AppKernel instead of it
    public function setApp( App $app )
    {
        $this->app = $app;
        //It allows use service container inside template system
        $this->tpl = $this->app->container->get('Renderer');
    }
}
