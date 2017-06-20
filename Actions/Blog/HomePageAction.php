<?php

require_once __dir__.'/../../Classes/TemplateLoader.php';
require_once __dir__.'/../../Classes/BlogPost.php';
require_once __dir__.'/../../Repo/BlogPost/BlogPostService.php';

class HomePageAction {

    static function go() {
        $loader = new TemplateLoader();
        $data = array();

        $blogPostService = new BlogPost\blogPostService();
        $allPublishedArticles = $blogPostService->fetchAllPublished();
        $data['AllPublishedArticles'] = $allPublishedArticles->fetchSimpleArray();

        $loader->loadTemplate('Blog/HomePage.html');
        return $loader->render($data);
    }
}
