<?php

require_once __dir__.'/../../../Classes/TemplateLoader.php';

class PasswordResetPage {

    static function go() {
        $loader = new TemplateLoader();
        $loader->loadTemplate('Admin/PasswordReset.html');
        $data = array();
        return $loader->render($data);
    }

}
