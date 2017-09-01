<?php

require_once __dir__.'/../../Utils/Functions.php';
require_once __dir__.'/../../Config.php';

class FetchStaticActions {

    static function fetchGeneralStatic($uriArray) {
        return self::resolveStaticPathAndFetch($GLOBALS['STATIC_DIR'], $uriArray);
    }

    static function fetchCSSStatic($uriArray) {
        header('Content-Type: text/css');
        return self::resolveStaticPathAndFetch($GLOBALS['CSS_STATIC_DIR'], $uriArray);
    }

    static function fetchJSStatic($uriArray) {
        return self::resolveStaticPathAndFetch($GLOBALS['JS_STATIC_DIR'], $uriArray);
    }

    static function fetchGeneralAdminStatic($uriArray) {
        return self::resolveStaticPathAndFetch($GLOBALS['ADMIN_STATIC_DIR'], $uriArray);
    }

    static function fetchAdminCSSStatic($uriArray) {
        header('Content-Type: text/css');
        return self::resolveStaticPathAndFetch($GLOBALS['ADMIN_CSS_DIR'], $uriArray);
    }

    static function fetchAdminJsStatic($uriArray) {
        return self::resolveStaticPathAndFetch($GLOBALS['ADMIN_JS_DIR'], $uriArray);
    }

    static function fetchBlogPostStatic($uriArray) {
        return self::resolveStaticPathAndFetch($GLOBALS['BLOG_POST_MEDIA_DIR'], $uriArray);
    }

    static function fetchBackgoundImageStatic($uriArray) {
        return self::resolveStaticPathAndFetch($GLOBALS['BACKGROUND_IMAGES_LOCATION'], $uriArray);
    }

    static function resolveStaticPathAndFetch($staticDirPath, $uriArray) {
        $uriArray = unsetAndRebase($uriArray, 0);
        $staticString = @file_get_contents($staticDirPath.reconstructPathFromArray($uriArray));
        if(!$staticString) {
            $staticString = $staticDirPath.reconstructPathFromArray($uriArray);
        }

        else {
            $fileName = array_values(array_slice($uriArray, -1))[0];
            self::setHeadersAccordingToFile($fileName);
        }

        return $staticString;
    }

    static function setHeadersAccordingToFile($filename) {
        header("Content-Length: " . filesize($filename));

        // fetch extension from filename
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        // check if css
        if (in_array($ext, array("css", "CSS"))) {
            header('Content-Type: text/css');
        }

        // check if image
        if (in_array($ext, array("jpeg", "JPEG", "jpg", "JPG"))) {
            header('Content-Type: image/jpeg');
        }

        if (in_array($ext, array("png", "PNG"))) {
            header('Content-Type: image/png');
        }

    }

    static function fetchCurrentBackground() {
        $files = scandir($GLOBALS['CURRENT_BACKGROUND_IMAGE_LOCATION']);
        $file = $files[2];

        self::setHeadersAccordingToFile($file);
        header("Location: "."/static/Media/BlogImages/CoverPage/Current/".$file);
    }

}
