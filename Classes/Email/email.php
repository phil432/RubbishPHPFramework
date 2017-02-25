<?php

require_once(__dir__.'/../Config.php');
require_once($GLOBALS['PHPMAILER_AUTOLOAD_LOCATION']);

class email {

    public static funtion send(
        $host,
        $port,
        $username,
        $password,
        $fromAddress,
        $replyTo,
        $addAddress,
        $subject,
        $msgHTML,
        $altBody
    ) {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Debugoutput = 'html';
        $mailer->SMTPDebug = $GLOBALS['SMTP_DEBUG_LEVEL'];
        $mailer->
    }

}
