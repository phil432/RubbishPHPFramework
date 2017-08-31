<?php

require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';
require_once __dir__.'/../../../Classes/BackgroundImageAdmin.php';

class AddNewBackgroundImage {
    const SUCCESS = "SUCCESS";
    const FAILURE = "FAILURE";

    static function go() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();

        $data = json_decode(file_get_contents("php://input"));
        $file = $_FILES['upload_file'];

        try {
            move_uploaded_file($file['tmp_name'], $GLOBALS['BACKGROUND_IMAGES_LOCATION'].'/'.$file['name']);
            $backgroundImageAdmin = new BackgroundImageAdmin();
            $backgroundImageAdmin->AddNewBackgroundImage("/background-images-location/".$file['name']);
            return json_encode(static::SUCCESS);
        } catch(Exception $e) {
            // Do nothing
        }

        return json_encode(static::FAILURE);
    }
}
