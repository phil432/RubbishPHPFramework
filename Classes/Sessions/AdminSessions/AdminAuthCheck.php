<?php

require_once __dir__.'/../../../Config.php';

class AdminAuthCheck {

    static function go() {
        @session_start();
        $now = new DateTime('now');
        if (@$_SESSION['is_authenticated'] && $_SESSION['last_activity']) {
            if ($now->getTimestamp() - $_SESSION['last_activity']->getTimestamp() < $GLOBALS['MAX_ADMIN_SESSION_INACTIVITY']) {
                $_SESSION['last_activity'] = $now;
                return true;
            }
        }
        session_unset();
        return false;
    }
}
