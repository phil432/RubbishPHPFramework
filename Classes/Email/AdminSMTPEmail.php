<?php

require_once __dir__.'/../../Config.php';
require_once($GLOBALS['PHPMAILER_LOCATION'].'/autoload.php');
require_once __dir__.'/SMTPEmail.php';

class AdminSMTPEmail extends SMTPEmail{

    function __construct ($toAddressArray, $subject, $msgHTML, $altBody)
    {
        parent::__construct(
            $GLOBALS['ADMIN_EMAIL_HOST'],
            $GLOBALS['ADMIN_EMAIL_HOST_PORT'],
            $GLOBALS['ADMIN_EMAIL'],
            $GLOBALS['ADMIN_EMAIL_PASSWORD'],
            $GLOBALS['ADMIN_EMAIL'],
            $GLOBALS['ADMIN_EMAIL'],
            $toAddressArray,
            $subject,
            $msgHTML,
            $altBody);
    }


}
