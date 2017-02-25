<?php
//require_once __dir__.'/TestInclude.php';
require_once __dir__.'/../Classes/Database.php';
require_once __dir__.'/../Repo/Db/DatabaseDetails/DatabaseDetailsService.php';

$dbConn = new Database();
//$dbConn->connect();
$testQuery = "SELECT * FROM user WHERE ?";
$paramsArray = array(1);
$results = $dbConn->query($testQuery, $paramsArray);

if ($results != null) {
    echo "well something happened";
} else {
    echo "well maybe something didnt happen";
}
var_dump($results);
