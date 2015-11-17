<?php

namespace FizzBuzz\Controller;

class Article extends AbstractController
{
    public function view()
    {


        $sectionsRepository = $this->app->container->get('SectionsRepository');
        $menuItems = $sectionsRepository->viewAllSections();
        $this->tpl->menuItems = $menuItems;

        $articleID = (int) $this->getRoutedParam('id');
        if (!$articleID) {
            throw new \Exception("Article ID is invalid", 404);
        }

        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $article = $articlesRepository->findById($articleID);

        if (!is_array($article) or !count($article)) {
            throw new \Exception("Article not found", 404);
        }

        if($article['slug'] !== $this->getRoutedParam('slug'))
        {
            header('Location: /read/'. $article['id'] . '-' . $article['slug']);
            die();
        }


/*        echo $this->getRoutedParam('slug');
        echo $this->getRoutedParam('id');
         echo $this->getRoutedParam('uri');
*/
         //print_r($article);
        $this->tpl->article = $article;
        echo $this->tpl->render('article/view.phtml');
    }
}
