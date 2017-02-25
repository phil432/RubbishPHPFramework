<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __dir__.'/Classes/Routing/UriParser.php';
require_once __dir__.'/Classes/Routing/UriMatcher.php';
require_once __dir__.'/Classes/BlogPost.php';
require_once __dir__.'/Utils/Functions.php';
require_once __dir__.'/Actions/Respond.php';

$uri = UriParser::splitUri($_SERVER['REQUEST_URI']);
$uriMatcher = new UriMatcher();

$action = $uriMatcher->resolveUri($uri);

echo Respond::go($action, $uri);
