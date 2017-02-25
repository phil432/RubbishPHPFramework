<?php

namespace DatabaseDetails;

require_once __dir__.'/Entity.php';
require_once __dir__.'/../../../Config.php';

class Repository {
    function fetchDefaultDetails() {
        $details = new Entity($GLOBALS['DB_HOST'], $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_NAME']);
        return $details;
    }
}
