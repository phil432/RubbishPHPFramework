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

    static function resolveStaticPathAndFetch($staticDirPath, $uriArray) {
        $uriArray = unsetAndRebase($uriArray, 0);
        $staticString = @file_get_contents($staticDirPath.reconstructPathFromArray($uriArray));
        if(!$staticString) {
            $staticString = $staticDirPath.reconstructPathFromArray($uriArray);
        }
        return $staticString;
    }

}
