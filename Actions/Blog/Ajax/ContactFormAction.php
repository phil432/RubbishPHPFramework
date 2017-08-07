<?php

require_once __dir__.'/../../../Utils/Functions.php';
require_once __dir__.'/../../../Classes/Email/BoatyBlogEmail.php';

class ContactFormAction {
    const SUCCESS = "SUCCESS";
    const FAILURE = "FAILURE";

    static function go() {
        // To do here. need to create session architecture. modify user to contain admin information
        $data = json_decode(file_get_contents("php://input"));

        $result = static::FAILURE;

        $toAddress = [
            'addressText' => $GLOBALS['ADMIN_EMAIL'],
            'addressName' => 'Phil Tebbutt'
        ];
        $addressArray = $array("toAddress");
        $messageText = "Email: ".$data->emailAddress.", Message: ".$data->messageBody;

        $message = new BoatyBlogEmail(
            $addressArray,
            "New message via Boaty Blog",
            $messageText,
            "hello"
        );

        $response = array(
            'result' => $result
        );

        return json_encode($response);
    }
}