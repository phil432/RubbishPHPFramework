<?php

require_once __dir__.'/../../../Utils/Functions.php';
require_once __dir__.'/../../../Classes/Sessions/AdminSessions/CreateAdminSession.php';

class AuthoriseAdminUser {
    const USER_DOES_NOT_EXIST_ERROR = "ERROR_USER_PASSWORD_MISSMATCH";
    const INCORRECT_PASSWORD_ERROR = "ERROR_USER_PASSWORD_MISSMATCH";
    const AUTHENTICATED = "SUCCESS_AUTHENTICATED";
    const UNKNOWN_ERROR = "ERROR_UNKNOWN";

    static function go() {
        // To do here. need to create session architecture. modify user to contain admin information
        $data = json_decode(file_get_contents("php://input"));
        $adminSession = new CreateAdminSession($data->user);

        $result = static::UNKNOWN_ERROR;
        if (!$adminSession->getUser()->getId()) {
            $result = static::USER_DOES_NOT_EXIST_ERROR;
        } else {
            if (!$adminSession->authenticate($data->password)) {
                $result = static::INCORRECT_PASSWORD_ERROR;
            } else {
                $result = static::AUTHENTICATED;
            }
        }

        $response = array(
            'result' => $result
        );

        return json_encode($response);
    }
}
