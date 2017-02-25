<?php

require_once __dir__.'/../../../Classes/TemplateLoader.php';
require_once __dir__.'/../../../Repo/UserDetails/UserDetailsService.php';
require_once __dir__.'/../../../Repo/PasswordReset/PasswordResetService.php';
require_once __dir__.'/../../../Config.php';

class SetNewPasswordPage {

    static function go($uriArray) {
        $output = SetNewPasswordPage::invalidUrlResponse();

        // fetch url code from uri array
        $urlCode = $uriArray[2];
        // make sure that uri array is valid
        $passwordResetService = new PasswordReset\PasswordResetService();
        $passwordReset = $passwordResetService->fetchPasswordResetByUrlCode($urlCode);

        if($passwordReset->getUserId() != null) {
            if ($passwordReset->checkIsValid()) {
                $loader = new TemplateLoader();
                $loader->loadTemplate('Admin/SetNewPassword.html');
                $data = array(
                    'url_code' => $urlCode
                );
                $output = $loader->render($data);
            }
        }
        return $output;
    }

    static function invalidUrlResponse()
    {
        $loader = new TemplateLoader();
        $loader->loadTemplate('Admin/SetNewPasswordInvalidUrl.html');
        $data = array();
        return $loader->render($data);
    }

}
