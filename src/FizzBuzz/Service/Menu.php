<?php

namespace FizzBuzz\Service;
use League\Container\ContainerInterface;

class Menu
{
	public function __construct( ContainerInterface $container )
	{
		$this->container = $container;
	}

	public function getSections()
	{
		return $this->container->get('SectionsRepository')->findAll();
	}
}