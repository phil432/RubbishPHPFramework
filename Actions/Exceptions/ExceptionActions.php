<?php

require_once __dir__.'/../../Classes/TemplateLoader.php';

class ExceptionActions {

    static function pageNotFound() {
        $loader = new TemplateLoader();
        $data = array();
        $loader->loadTemplate('Exceptions/404Error.html');
        return $loader->render($data);
    }
}
