<?php

require_once __dir__.'/../../Classes/TemplateLoader.php';
require_once __dir__.'/../../Classes/BlogPost.php';
require_once __dir__.'/../../Repo/BlogPost/BlogPostService.php';

class ContactPageAction {

    static function go() {
        $loader = new TemplateLoader();
        $data = array();
        $loader->loadTemplate('Blog/CoverPage.html');
        return $loader->render($data);
    }
}
