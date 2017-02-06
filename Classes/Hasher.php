<?php
require_once __dir__.'/../Config.php';

class Hasher {
    public static function hash($charstring) {
        $options = array('cost' => $GLOBALS['BCRYPT_COST']);
        $hash = password_hash($charstring, PASSWORD_BCRYPT, $options);
        return $hash;
    }

    public static function checkStringMatch($checkString, $hash) {
        return password_verify($checkString, $hash);
    }
}
