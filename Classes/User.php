<?php

require_once __dir__.'/../Repo/UserDetails/UserDetailsService.php';
require_once __dir__.'/../Repo/UserDetails/Entity.php';
require_once __dir__.'/Hasher.php';

class User {
    protected $userDetails = null;

    function __construct($userDetails) {
        $this->userDetails = $userDetails;
    }

    function getId() {
        return $this->userDetails->getId();
    }

    function getNickname(){
        return $this->userDetails->getNickname();
    }

    function setNickname($nickname) {
        $this->userDetails->setNickname($nickname);
    }

    function getEmailAddress() {
        return $this->userDetails->getEmailAddress();
    }

    function setEmailAddress($emailaddress) {
        $this->userDetails->setEmailAddress($emailaddress);
    }

    function getIsAdmin() {
        return $this->userDetails->getIsAdmin();
    }

    function setIsAdmin($isAdmin) {
        $this->userDetails->setIsAdmin($isAdmin);
    }

    function setPassword($password) {
        $passwordHash = Hasher::hash($password);
        $this->userDetails->setPasswordHash($passwordHash);
    }

    function checkPassword($checkString) {
        return Hasher::checkStringMatch($checkString, $this->userDetails->getPasswordHash());
    }

    function getUserDetails() {
        return $this->userDetails;
    }
}
