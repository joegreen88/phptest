<?php

namespace FizzBuzz\Controller;

class Homepage extends AbstractController
{
    public function homepage()
    {
        echo $this->tpl->render('homepage.phtml');
    }

    public function phpinfo()
    {
        phpinfo();
    }
}
