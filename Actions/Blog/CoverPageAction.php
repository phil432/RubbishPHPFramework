<?php

require_once __dir__.'/../../Classes/TemplateLoader.php';

class CoverPageAction {

    static function go() {
        $loader = new TemplateLoader();
        $data = array();
        $loader->loadTemplate('Blog/CoverPage.html');
        return $loader->render($data);
    }
}
