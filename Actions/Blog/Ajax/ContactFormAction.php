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
        $addressArray = array($toAddress);

        $loader = new TemplateLoader();
        $data = array(
            "email" => $data->emailAddress,
            "message_text" => $data->messageBody
        );
        $loader->loadTemplate('Blog/ContactNotification.html');
        $messageText = $loader->render($data);
        $altMessageText = "Email: ".$data['email'].", Message: ".$data['message_text'];

        $message = new BoatyBlogEmail(
            $addressArray,
            "New message via Boaty Blog",
            $messageText,
            $altMessageText
        );

        if($message->send()) {
            $result = static::SUCCESS;
        }

        $response = array(
            'result' => $result
        );

        return json_encode($response);
    }
}
