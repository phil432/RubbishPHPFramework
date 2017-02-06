<?php

require_once __dir__.'/../../../Classes/User.php';

class CreateAdminSession {
    private $user;
    private $lastActivity;
    private $sessionLoginDate;
    private $isAuthenticated = false;

    function __construct($userEmail) {
        $this->userDetailsService = new UserDetails\UserDetailsService();
        $this->user = new User($this->userDetailsService->fetchUserDetailsByEmail($userEmail));
    }

    function authenticate($password) {
        if ($this->isAuthenticated = $this->user->checkPassword($password)) {
            $this->sessionLoginDate = new DateTime('now');
            session_start();
            $_SESSION['user_id'] = $this->user->getId();
            $_SESSION['user_nickname'] = $this->user->getNickname();
            $_SESSION['user_email'] = $this->user->getEmailAddress();
            $_SESSION['is_authenticated'] = true;
            $_SESSION['login_date'] = $this->sessionLoginDate;
            $_SESSION['last_activity'] = $this->sessionLoginDate;
        }
        return $this->isAuthenticated;
    }

    function getUser() {
        return $this->user;
    }
}
