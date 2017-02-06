<?php

require_once __dir__.'/../../../Classes/TemplateLoader.php';

class LoginPage {

    static function renderLoginPage() {
        $loader = new TemplateLoader();
        $loader->loadTemplate('Admin/LoginPage.html');
        $data = array();
        return $loader->render($data);
    }

}
