<?php

namespace FizzBuzz\Controller;

class Homepage extends AbstractController
{
    public function menuItems()
    {
        $sectionsRepository = $this->app->container->get('SectionsRepository');
        $menuItems = $sectionsRepository->viewAllSections();
        $this->tpl->menuItems = $menuItems;
    }

    public function homepage()
    {
        //call menu on homepage
        $this->menuItems();
        
        // We display articles from the news section on the homepage
        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $articles = $articlesRepository->findAll(['section_id' => 1]);

        if (is_array($articles) && count($articles)) {
            $this->tpl->articles = $articles;
        } else {
            $this->tpl->articles = null;
        }

        echo $this->tpl->render('homepage.phtml');

    }

    public function phpinfo()
    {
        phpinfo();
    }

    public function handle404()
    {
        //display menu items even on 404 page otherwise we get an error. 
        $this->menuItems();

        $this->app->response->setStatusCode(404);
        
        $this->tpl->uri = $this->getRoutedParam('uri');

        echo $this->tpl->render('404.phtml');
    }


}
