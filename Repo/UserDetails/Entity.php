<?php

namespace UserDetails;

class Entity {
    private $id;
    private $nickname;
    private $emailAddress;
    private $passwordHash;
    private $isAdmin;

    function __construct($id, $nickname, $emailAddress, $passwordHash, $isAdmin = false) {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->emailAddress = $emailAddress;
        $this->passwordHash = $passwordHash;
        $this->isAdmin = $isAdmin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function getNickname() {
        return $this->nickname;
    }

    function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    function setEmailAddress($emailAddress) {
        $this->emailAddress = $emailAddress;
    }

    function getEmailAddress() {
        return $this->emailAddress;
    }

    function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
    }

    function getPasswordHash() {
        return $this->passwordHash;
    }

    function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }

    function getIsAdmin() {
        return $this->isAdmin;
    }
}
