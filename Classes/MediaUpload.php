<?php
require_once __dir__.'/../Config.php';

class MediaUpload {
    private $blogId;
    private $file;

    function __construct($blogId) {
        $this->blogId = $blogId;
    }

    public function createDirIfNotExists() {
        if($this->checkIfDirExists() == false) {
            $this->createDir();
        } else {
            // do some logging here eventually
        }
    }

    public function checkIfDirExists() {
        $result = false;
        if (file_exists($this->determineDirPath())) {
            $result = true;
        }
        return $result;
    }

    public function createDir() {
        try {
            mkdir($this->determineDirPath(), 755, true);
        } catch(Exception $e) {
            // do some logging here one day
        }
    }

    // will be private
    public function determineDirPath() {
        $path = $GLOBALS['BLOG_POST_MEDIA_DIR'].'/'.$this->blogId;
        return $path;
    }

    public function deleteDir() {
        // todo
    }

    public function createFileName() {
        $filename = $this->blogId."-";
        $uniqIdString = uniqid();

        $fileExtension = pathinfo($this->file['name'], PATHINFO_EXTENSION);

        return $filename.$uniqIdString.".".$fileExtension;
    }

    public function createFullPath() {
        $dirPath = $this->determineDirPath();
        $fileName = $this->createFileName();
        return $dirPath."/".$fileName;
    }

    public function writeToFile($file) {
        $this->file = $file;
        $this->createDirIfNotExists();
        $filePath = $this->createFullPath();
        try {
            move_uploaded_file($this->file['tmp_name'], $filePath);
            $this->file = null;
            return $filePath;
        } catch (Exception $e) {
            return "file could not be uploaded";
        }

    }
}
