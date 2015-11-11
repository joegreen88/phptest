<?php

namespace FizzBuzz\Service;

interface RepositoryInterface
{
    public function findAll();

    public function findById($id);
}
