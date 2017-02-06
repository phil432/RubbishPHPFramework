<?php

require_once __dir__.'/../../Classes/Sessions/AdminSessions/AdminAuthCheck.php';

function redirectToAdminLoginPage() {
    header("Location: ".$GLOBALS['HOST_WEB_ADDRESS']."/admin/login", true, 302);
}

function checkIfLoggedInAndRedirectIfNot() {
    if (!AdminAuthCheck::go()) {
        redirectToAdminLoginPage();
    }
}
