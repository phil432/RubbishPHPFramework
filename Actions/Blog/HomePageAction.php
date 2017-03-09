<?php

require_once __dir__.'/../../Classes/TemplateLoader.php';

class HomePageAction {

    static function go() {
        $loader = new TemplateLoader();
        $data = array();
        $loader->loadTemplate('Blog/HomePage.html');
        return $loader->render($data);
    }
}
