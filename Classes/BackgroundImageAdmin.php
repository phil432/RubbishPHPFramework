<?php

require_once __dir__.'/Database.php';
require_once __dir__.'/../Config.php';

class BackgroundImageAdmin {

    private $connection;

    function __construct() {
        $this->connection = new Database();
    }

    function addNewBackgroundImage($url) {
        $queryString = "INSERT INTO background_image (url) VALUES (?)";
        $this->connection->query($queryString, array($url));
        return $this->connection->lastInsertId();
    }

    function fetchBackgroundImageById($id) {
        $queryString = "SELECT * FROM background_image WHERE id = ?";
        $result = $this->connection->query($queryString, array($id));
        return $result[0];
    }

    function deleteBackgroundImage($id) {
        $imageDetails = $this->fetchBackgroundImageById($id);
        $imageUrl = $imageDetails['url'];

        // parse filename from url
        $imageUrlArray = explode("/", $imageUrl);
        $imageFilename = array_pop($imageUrlArray);

        // build filepath
        $imagePath = $GLOBALS['BACKGROUND_IMAGES_LOCATION']."/".$imageFilename;

        $success = unlink($imagePath);
        if ($success == true && $imageFilename != null) {
            $queryString = "DELETE FROM background_image WHERE id = ?";
            $this->connection->query($queryString, array($id));
        }
        return $success;
    }

    function setBackgroundImage($id) {
        $files = glob($GLOBALS['CURRENT_BACKGROUND_IMAGE_LOCATION'].'/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
            unlink($file); // delete file
        }

        $backgroundImage = $this->fetchBackgroundImageById($id);
        $urlArray = explode("/", $backgroundImage['url']);
        $filename = array_pop($urlArray);
        $fullPath = $GLOBALS['BACKGROUND_IMAGES_LOCATION']."/".$filename;
        $newPath = $GLOBALS['CURRENT_BACKGROUND_IMAGE_LOCATION']."/".$filename;

        if(copy($fullPath, $newPath)) {
            $queryString = "UPDATE blog_settings SET background_image_id = ?";
            $this->connection->query($queryString, array($id));
        }
    }

    function fetchAllBackgroundImages() {
        return $this->connection->query("SELECT * FROM background_image");
    }

    function fetchCurrentBackgroundImage() {
        $queryString = "SELECT background_image.id, background_image.url
                FROM background_image
                INNER JOIN blog_settings
                ON blog_settings.background_image_id = background_image.id";
        $result = $this->connection->query($queryString);
        if ($result == null) {
            return 0;
        } else {
            return $result[0];
        }
    }
}
