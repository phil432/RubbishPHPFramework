<?php

require_once __dir__.'/../../../Utils/Functions.php';
require_once __dir__.'/../../../Classes/Sessions/AdminSessions/CreateAdminSession.php';
require_once __dir__.'/../../../Classes/Email/AdminSMTPEmail.php';
require_once __dir__.'/../../../Repo/UserDetails/UserDetailsService.php';
require_once __dir__.'/../../../Repo/PasswordReset/PasswordResetService.php';
require_once __dir__.'/../../../Classes/User.php';

class PasswordResetAction {
    const USER_DOES_NOT_EXIST_ERROR = "USER_NOT_FOUND";
    const USER_FOUND = "SUCCESS";

    static function go() {
        // To do here. need to create session architecture. modify user to contain admin information
        $data = json_decode(file_get_contents("php://input"));
        $UserDetailsService = new userDetails\UserDetailsService();
        $user = new User($UserDetailsService->fetchUserDetailsByEmail($data->reset_email));

        $result = static::USER_DOES_NOT_EXIST_ERROR;
        if ($user->getId() != null) {
            $result = static::USER_FOUND;

            // generte new password reset
            $passwordResetService = new PasswordReset\PasswordResetService();

            $passwordReset = $passwordResetService->createNewPasswordReset($user->getId());

            // send the email
            $toAddress = [
                'addressText' => 'philtebbutt@hotmail.com',
                'addressName' => 'Phil Tebbutt'
            ];
            $addressArray = array($toAddress);

            //create message text

            $linkToBeFollowed = PasswordResetAction::createPasswordResetUrl($passwordReset);
            $messageText = "<p>Follow this link: <a href='".$linkToBeFollowed."'>".$linkToBeFollowed."</a>'</p>";

            // send the email
            $adminEmail = new AdminSMTPEmail(
                $addressArray,
                'Password Reset',
                $messageText,
                $linkToBeFollowed
            );

            // one day proper logging should be put here but at the moment there is no need
            $adminEmail->send();

        }
        $response = array(
            'result' => $result
        );

        return json_encode($response);
    }

    static function createPasswordResetUrl($passwordReset) {
        $url = $GLOBALS['HOST_WEB_ADDRESS'].'/admin/set-new-password/';
        return $url.$passwordReset->getUrlCode();
    }
}
