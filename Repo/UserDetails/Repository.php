<?php

namespace UserDetails;

require_once __dir__.'/Storage/Db.php';
require_once __dir__.'/Mapper.php';

class Repository {

    private $db = null;

    function __construct() {
        $this->db = new Db();
    }

    function fetchBlankDetails() {
        $detailsArray = array(
            'id' => '',
            'nickname' => '',
            'email_address' => '',
            'password_hash' => '',
            'is_admin' => false
        );
        return @Mapper::fromArray($detailsArray);
    }

    function fetchUserDetailsByEmail($emailAddress) {
        $detailsArray = $this->db->fetchUserByEmail($emailAddress);
        return @Mapper::fromArray($detailsArray[0]);
    }

    function fetchUserDetailsById($id) {
        $detailsArray = $this->db->fetchUserById($id);
        return @Mapper::fromArray($detailsArray[0]);
    }

    function saveUserDetails($entity) {
        $this->db->updateUserById($entity);
    }

    function addNewUserDetails($entity) {
        return $this->db->createUser($entity);
    }
}
