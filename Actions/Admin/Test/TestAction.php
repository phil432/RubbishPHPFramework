<?php

require_once __dir__.'/../../../Classes/TemplateLoader.php';

class LoginPage {

    static function renderLoginPage() {
        $loader = new TemplateLoader();
        $loader->loadTemplate('Test/Test.html');
        $data = array('test_text' => "hello from test template");
        return $loader->render($data);
    }

}
