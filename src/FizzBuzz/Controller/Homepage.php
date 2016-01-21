<?php

namespace FizzBuzz\Controller;

class Homepage extends AbstractController
{
    public function homepage()
    {
        // We display articles from the news section on the homepage
        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $articles = $articlesRepository->findAll(['section_id' => 1]);

        if (is_array($articles) && count($articles)) {
            $this->tpl->articles = $articles;
        } else {
            $this->tpl->articles = null;
        }

        $content = $this->tpl->render('homepage.phtml');
        $this->app->response->setContent( $content );
    }

    public function phpinfo()
    {
        phpinfo();
    }

    public function handle404()
    {
        
        $this->app->response->setStatusCode(404);
        
        $this->tpl->uri = $this->getRoutedParam('uri');

        $content = $this->tpl->render('404.phtml');
        $this->app->response->setContent( $content );
    }
}
