<?php

namespace FizzBuzz\Controller;

class Article extends AbstractController
{
    public function view()
    {
        $articleId = (int) $this->getRoutedParam('id');
        $articleSlug = $this->getRoutedParam('slug');

        if (!$articleId) {
            throw new \Exception("Article ID is invalid", 404);
        }

        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $articleModel = $articlesRepository->findById($articleId);

        if (!$articlesRepository->articleExist($articleId, $articleSlug)) {
            return $this->redirect('read/'. $articleModel['id'] .'-'.$articleModel['slug']);
        }

        if (!is_array($articleModel) or !count($articleModel)) {
            throw new \Exception("Article not found", 404);
        }
        $this->tpl->article = $articleModel;
        echo $this->tpl->render('article/view.phtml');
    }
}
