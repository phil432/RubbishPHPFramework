<?php

require_once __dir__.'/../../../Classes/TemplateLoader.php';
require_once __dir__.'/../../../Repo/UserDetails/UserDetailsService.php';
require_once __dir__.'/../../../Classes/User.php';
require_once __dir__.'/../../../Classes/Sessions/AdminSessions/CreateAdminSession.php';
require_once __dir__.'/../../../Repo/PasswordReset/PasswordResetService.php';
require_once __dir__.'/../../../Config.php';

class SetNewPassword {

    static function go() {
        $responseArray = array();

        $data = json_decode(file_get_contents("php://input"));

        $urlCode = $data->url_code;
        $newPassword = $data->new_password;

        $passwordResetService = new PasswordReset\PasswordResetService();
        $passwordReset = $passwordResetService->fetchPasswordResetByUrlCode($urlCode);

        if ($passwordReset) {
            $userId = $passwordReset->getUserId();

            // fetch the user
            $userService = new UserDetails\UserDetailsService();
            $user = new User($userService->fetchUserDetailsById($userId));
            if ($user->getId()) {
                $user->setPassword($newPassword);
                $passwordResetService->deleteAllPasswordResetsByUserId($user->getId());
                $userService->saveUserDetails($user->getUserDetails());
                $adminSession = new CreateAdminSession($user->getEmailAddress());
                $adminSession->authenticate($newPassword);
                $responseArray['result'] = "SUCCESS";

            } else {
                $responseArray['result'] = 'RESET_FAILED';
            }
        } else {
            $responseArray['result'] = 'RESET_FAILED';
        }

        return json_encode($responseArray);
    }
}
