<?php

namespace UserDetails;

require_once __dir__.'/Repository.php';

class UserDetailsService {

    private $repository = null;

    function __construct() {
        $this->repository = new Repository();
    }

    function fetchUserDetailsById($id) {
        return $this->repository->fetchUserDetailsById($id);
    }

    function fetchUserDetailsByEmail($emailAddress) {
        return $this->repository->fetchUserDetailsByEmail($emailAddress);
    }

    function addNewUserDetails($entity) {
        return $this->repository->addNewUserDetails($entity);
    }

    function saveUserDetails($entity) {
        $this->repository->saveUserDetails($entity);
    }

    function fetchBlankUserDetails() {
        return $this->repository->fetchBlankDetails();
    }
}
