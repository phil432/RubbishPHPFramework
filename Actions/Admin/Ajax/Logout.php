<?php

require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';

class Logout {

    const SESSION_ENDED = "SESSION_ENDED";

    static function go() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        session_destroy();
    }
}
