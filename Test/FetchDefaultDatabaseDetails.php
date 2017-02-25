<?php
require_once '../Repo/Db/DatabaseDetails/DatabaseDetailsService.php';

require_once 'TestInclude.php';

$dbDetailsService = new DatabaseDetails\DatabaseDetailsService();

$details = $dbDetailsService->fetchDefaultDetails();
var_dump($details);
