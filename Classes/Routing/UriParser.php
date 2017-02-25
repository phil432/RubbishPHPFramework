<?php
include_once __dir__.'/../../Utils/Functions.php';

class UriParser {

    static function splitUri($uriString) {
        $splitUri = explode('?', $uriString);
        if (sizeof($splitUri) > 2) {
            // raise exception because of invalid parameters
        }
        $path = $splitUri[0];
        $pathArray = explode('/', $path);
        $pathArray = unsetAndRebase($pathArray, 0);


        return $pathArray;
    }

    static function fourZeroFour() {
        //return a uri that should take the request to 404 page
        return null;
    }
}
