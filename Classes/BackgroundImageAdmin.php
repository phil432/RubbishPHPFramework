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

    function deleteBackgroundImage($id) {
        $queryString = "DELETE FROM background_image WHERE id = ?";
        $this->connection->query($queryString, array($id));
    }

    function setNewBackgroundImage($id) {
        $queryString = "UPDATE blog_settings SET background_image = ?";
        $this->connection->query($queryString, array($id));
    }

    function fetchAllBackgroundImages() {
        return $this->connection->query("SELECT * FROM background_image");
    }

    function fetchCurrentBackgroundImage() {
        $queryString = "SELECT background_image.id, background_image.url
                FROM background_image
                INNER JOIN blog_settings
                ON blog_settings.background_image_id = background_image.id";
        return $this->connection->query($queryString);
    }
}
