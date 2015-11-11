<?php

namespace FizzBuzz\Controller;

class Section extends AbstractController
{
    public function view()
    {
        $slug = $this->getRoutedParam('slug');

        $sectionsRepository = $this->app->container->get('SectionsRepository');
        $section = $sectionsRepository->findBySlug($slug);

        if (!is_array($section) or !count($section)) {
            throw new \Exception("Section not found", 404);
        }

        $this->tpl->section = $section;

        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $articles = $articlesRepository->findAll(['section_id' => $section['id']]);

        if (!is_array($articles) or !count($articles)) {
            $this->tpl->articles = null;
        } else {
            $this->tpl->articles = $articles;
        }

        echo $this->tpl->render('section/view.phtml');
    }
}
