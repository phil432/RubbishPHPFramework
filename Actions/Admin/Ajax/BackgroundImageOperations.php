<?php

require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';
require_once __dir__.'/../../../Classes/BackgroundImageAdmin.php';

class BackgroundImageOperations {
    const SUCCESS = "SUCCESS";
    const FAILURE = "FAILURE";

    static function deleteBackgroundImage()
    {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $data = json_decode(file_get_contents("php://input"));

        $backgroundImageAdmin = new BackgroundImageAdmin();
        $backgroundImageId = $data->id;
        $success = $backgroundImageAdmin->deleteBackgroundImage($backgroundImageId);

        if($success = true) {
            return json_encode(array("status" => static::SUCCESS));
        } else {
            return json_encode(array("status" => static::FAILURE));
        }
    }

    static function fetchAllBackgrounds()
    {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $data = json_decode(file_get_contents("php://input"));

        $backgroundImageAdmin = new BackgroundImageAdmin();
        $allImages = $backgroundImageAdmin->fetchAllBackgroundImages();

        return json_encode($allImages);
    }

    static function addNewBackgroundImage()
    {
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

    static function fetchCurrentBackgroundImageId() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();

        $backgroundImageAdmin = new BackgroundImageAdmin();
        $currentBackground = $backgroundImageAdmin->fetchCurrentBackgroundImage();
        $currentBackgroundId = $currentBackground['id'];
        return json_encode(array("id" => $currentBackgroundId));
    }

    static function setCurrentBackgound() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        $backgroundImageAdmin = new BackgroundImageAdmin();
        $backgroundImageAdmin->setBackgroundImage($id);

        return $id;
    }
}
