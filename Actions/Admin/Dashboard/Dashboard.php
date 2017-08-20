<?php

require_once __dir__.'/../../../Classes/TemplateLoader.php';
require_once __dir__.'/../../../Classes/Sessions/AdminSessions/AdminAuthCheck.php';
require_once __dir__.'/../LoginPage/LoginPage.php';
require_once __dir__.'/../../../Config.php';
require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';
require_once __dir__.'/../../../Repo/BlogPost/BlogPostService.php';
require_once __dir__.'/../../../Repo/BlogPost/Mapper.php';
require_once __dir__.'/../../../Classes/BlogPost.php';

class Dashboard {

    static function showWelcomePage($uriArray) {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $loader = new TemplateLoader();
        $loader->loadTemplate('/Admin/Dashboard/Base.html');
        $data = array('username' => $_SESSION['user_nickname']);
        return $loader->render($data);
    }

    static function loadBlogEditPanel($uriArray) {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $loader = new TemplateLoader();
        $loader->loadTemplate('/Admin/Dashboard/BlogEdit.html');
        $data = array();
        return $loader->render($data);
    }

    static function loadBlogSettingsAction($uriArray) {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $loader = new TemplateLoader();
        $loader->loadTemplate('/Admin/Dashboard/BlogSettings.html');
        $data = array();
        return $loader->render($data);
    }

    static function loadBlogEditPanelWidget($uriArray) {
        session_start();
        checkIfLoggedInAndRedirectIfNot();

        $blogArray = array();
        $blogArray['id'] = 0;
        $blogArray['save_status'] = 'NOSAVESTATUS';
        if ($_GET['blog_post_id'] != 0) {
            $blogPostId = $_GET['blog_post_id'];
            $blogPostService = new BlogPost\BlogPostService();
            $blogArray = BlogPost\Mapper::toArray($blogPostService->fetchBlogPostById($blogPostId));
            $blogArray['save_status'] = 'SAVED';
        }

        $blogPost = new BlogPost(BlogPost\Mapper::fromArray($blogArray));

        $loader = new TemplateLoader();
        $loader->loadTemplate('/Admin/Dashboard/Components/BlogEditPanel.html');
        return $loader->render($blogArray);
    }

    static function loadBlogSearchPanel($uriArray) {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $loader = new TemplateLoader();
        $loader->loadTemplate('/Admin/Dashboard/Components/BlogSearchPanel.html');
        $data = array();
        return $loader->render($data);
    }

    static function loadBackgroundImagePanel($uriArray) {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $loader = new TemplateLoader();
        $loader->loadTemplate('/Admin/Dashboard/Components/BackgroundImageAdmin.html');
        $data = array();
        return $loader->render($data);
    }
}
