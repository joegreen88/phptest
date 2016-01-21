<?php

namespace FizzBuzz\Controller;

use \Symfony\Component\HttpFoundation\Response;

class Article extends AbstractController
{
    public function view()
    {
        $articleID = (int) $this->getRoutedParam('id');
        $articleSlug = (string) $this->getRoutedParam('slug');

        if (!$articleID) {
            throw new \Exception("Article ID is invalid", 404);
        }

        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $article = $articlesRepository->findById($articleID);

        if (!is_array($article) or !count($article)) {
            throw new \Exception("Article not found", 404);
        }

        if( $article['slug'] != $articleSlug )
        {
            $url = $this->app->router->generate( 'article-view', array( 
                'id' => $article['id'],
                'slug' => $article['slug']
            ));

            //Redirect to URL with the right slug
            //Another way could be use the static method Request::create and use the construct
            //to create a new response and set attributes easier. If it is done, send() 
            //method should be executed
            $this->app->response->setStatusCode( Response::HTTP_TEMPORARY_REDIRECT );
            $this->app->response->headers->set('location', $url );
            return;
        }

        $this->tpl->article = $article;
        $content = $this->tpl->render('article/view.phtml');
        
        $this->app->response->setContent( $content );
    }
}
