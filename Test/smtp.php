<?php
//require_once __dir__.'/../Config.php';
//require_once($GLOBALS['PHPMAILER_LOCATION'].'/autoload.php');

/*
$hello = new PHPMailer();

$hello->isSMTP();
$hello->SMTPDebug = 4;
$hello->Timeout = 20;
$hello->Debugoutput = 'html';
$hello->Host = $GLOBALS['ADMIN_EMAIL_HOST'];
$hello->Port = $GLOBALS['ADMIN_EMAIL_HOST_PORT'];
$hello->SMTPAuth = true;
$hello->Username = $GLOBALS['ADMIN_EMAIL'];
$hello->Password = $GLOBALS['ADMIN_EMAIL_PASSWORD'];
$hello->From = $GLOBALS['ADMIN_EMAIL'];
$hello->addReplyTo = $GLOBALS['ADMIN_EMAIL'];
$hello->addAddress('philtebbutt@hotmail.com', 'phil tebbutt');
$hello->Subject = 'hello. this is a test email. hopefully it works';
$hello->msgHTML('hello this is a test email');
$hello->AltBody ='hello this is a test email hello';

if (!$hello->send()) {
    echo "Mailer Error: " . $hello->ErrorInfo;
} else {
    echo "Message sent!";
}
*/

require_once __dir__.'/../Classes/Email/AdminSMTPEmail.php';

$toAddress1 = [
    'addressText' => 'philtebbutt@hotmail.com',
    'addressName' => 'Phil Tebbutt'
];

$addressArray = [$toAddress1];

$email = new AdminSMTPEmail($addressArray, 'this is a subject', '<h1>this is the message html</h1>', 'i have no idea what this is for');
$email->send();
