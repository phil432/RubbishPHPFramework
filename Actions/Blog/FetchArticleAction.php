<?php

require_once __dir__.'/../../Classes/TemplateLoader.php';
require_once __dir__.'/../../Classes/BlogPost.php';
require_once __dir__.'/../../Repo/BlogPost/BlogPostService.php';

class FetchArticleAction {

    static function fetchById($uriArray) {
        $requestedArticleId = $uriArray[1];
        $blogPostService = new BlogPost\blogPostService();
        $articleData = $blogPostService->fetchBlogPostById($requestedArticleId);

        $loader = new TemplateLoader();
        $data = BlogPost\Mapper::toArray($articleData);
        $loader->loadTemplate('Blog/ArticlePage.html');
        return $loader->render($data);
    }

    static function fetchBySlug($uriArray) {
        $loader = new TemplateLoader();
        $data = array();

        $blogPostService = new BlogPost\blogPostService();
        $allPublishedArticles = $blogPostService->fetchAllPublished();
        $data['AllPublishedArticles'] = $allPublishedArticles->fetchSimpleArray();

        $loader->loadTemplate('Blog/HomePage.html');
        return $loader->render($data);
    }

    static function FetchNotFound() {
        $loader = new TemplateLoader();
        $data = array();

        $blogPostService = new BlogPost\blogPostService();
        $allPublishedArticles = $blogPostService->fetchAllPublished();
        $data['AllPublishedArticles'] = $allPublishedArticles->fetchSimpleArray();

        $loader->loadTemplate('Blog/HomePage.html');
        return $loader->render($data);
    }
}
