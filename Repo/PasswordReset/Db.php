<?php

namespace PasswordReset;

require_once __dir__.'/../../Classes/Database.php';
require_once __dir__.'/../../Config.php';

class Db {

    private $connection;

    function __construct() {
        $this->connection = new \Database();
    }

    function insetNewPasswordReset($passwordReset) {
        $queryString = "INSERT INTO user_password_reset (url_code, user_id) VALUES (?,?)";

        $this->connection->query($queryString, array(
            $passwordReset->getUrlCode(),
            $passwordReset->getUserId()
        ));
    }

    function fetchPasswordResetByUrlCode($urlCode) {
        $queryString = "SELECT * FROM user_password_reset WHERE url_code = ? LIMIT 1";
        return $this->connection->query($queryString, array($urlCode));
    }

    function deleteAllPasswordResetsByUserId($userId) {
        $queryString = "DELETE FROM user_password_reset WHERE user_id = ?";
        return $this->connection->query($queryString, array($userId));
    }

    function deleteAllExpired() {

    }

}
