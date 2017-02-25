<?php

namespace DatabaseDetails;

class Entity {
    private $host;
    private $dbName;
    private $dbUser;
    private $dbPassword;

    function __construct($host, $dbUser, $dbPassword, $dbName) {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
    }

    function getHost() {
        return $this->host;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function getName() {
        return $this->dbName;
    }

    function setName($dbName) {
        $this->dbName = $dbName;
    }

    function getUser() {
        return $this->dbUser;
    }

    function setUser($dbUser) {
        $this->dbUser = $dbUser;
    }

    function getPassword() {
        return $this->dbPassword;
    }

    function setPassword($dbPassword) {
        $this->dbPassword = $dbPassword;
    }

}
