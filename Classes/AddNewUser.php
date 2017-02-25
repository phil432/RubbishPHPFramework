<?php

require_once __dir__.'/../Repo/UserDetails/UserDetailsService.php';
require_once __dir__.'/../Repo/UserDetails/Entity.php';
require_once __dir__.'/User.php';

class AddNewUser extends User {

    function __construct() {
        // do nothing
    }

    function go($nickname, $emailAddress, $password, $isAdmin = false) {
        $userDetailsService = new userDetails\UserDetailsService();
        $this->userDetails = $userDetailsService->fetchBlankUserDetails();
        $this->setNickname($nickname);
        $this->setEmailAddress($emailAddress);
        $this->setPassword($password);
        $this->setIsAdmin($isAdmin);

        $userDetailsService->addNewUserDetails($this->getUserDetails());
    }
}
