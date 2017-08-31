<?php

require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';
require_once __dir__.'/../../../Classes/BackgroundImageAdmin.php';

class FetchAllBackgrounds {
    const SUCCESS = "SUCCESS";
    const FAILURE = "FAILURE";

    static function go() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $data = json_decode(file_get_contents("php://input"));

        $backgroundImageAdmin = new BackgroundImageAdmin();
        $allImages = $backgroundImageAdmin->fetchAllBackgroundImages();

        return json_encode($allImages);
    }
}
