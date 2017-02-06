<?php

require_once __dir__.'/../../Config.php';
require_once($GLOBALS['PHPMAILER_LOCATION'].'/autoload.php');

class SMTPEmail {

    private $mailer = null;

    function __construct (
        $host,
        $port,
        $username,
        $password,
        $fromAddress,
        $replyTo,
        $addAddressArray,
        $subject,
        $msgHTML,
        $altBody)
    {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Debugoutput = 'html';
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPDebug = $GLOBALS['SMTP_DEBUG_LEVEL'];
        $this->mailer->Timeout = $GLOBALS['SMTP_EMAIL_TIMEOUT'];
        $this->mailer->Host = $host;
        $this->mailer->Port = $port;
        $this->mailer->Username = $username;
        $this->mailer->Password = $password;
        $this->mailer->From = $fromAddress;
        $this->mailer->addReplyTo = $replyTo;
        $this->mailer->Subject = $subject;
        $this->mailer->msgHTML($msgHTML);
        $this->mailer->AltBody = $altBody;

        foreach ($addAddressArray as $address) {
            $this->mailer->addAddress($address['addressText'], $address['addressName']);
        }
    }

    public function send() {
        if (!$this->mailer->send()) {
            // add some proper logging here at some point
            // echo "Mailer Error: ".$this->mailer->ErrorInfo;
        } else {
            // Do some proper logging here one day too
        }
    }

}
