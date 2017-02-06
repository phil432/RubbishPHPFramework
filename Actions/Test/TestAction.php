<?php

require_once __dir__.'/../../Classes/TemplateLoader.php';

class TestAction {

    static function go() {
        $loader = new TemplateLoader();
        $loader->loadTemplate('Test/Test.html');
        $data = array('test_text' => "hello from test template");
        return $loader->render($data);
    }

}
