<?php

/*
* This is a safe config file. To make it actually work you need to rename it by
* removing the '-safe' from the filename. Then you will need to fill out the
* missing config things. Obviously.
*/

$GLOBALS['HOST_WEB_ADDRESS'] = '';
// Database credentials
$GLOBALS['DB_HOST'] = '';
$GLOBALS['DB_USER'] = '';
$GLOBALS['DB_PASSWORD'] = '';
$GLOBALS['DB_NAME'] = '';

// Hashing and crypt
$GLOBALS['BCRYPT_COST'] = 15;

// Twig Config
$GLOBALS['TWIG_AUTOLOADER_PATH'] = __dir__.'/vendor/twig/twig/lib/Twig/Autoloader.php';
$GLOBALS['TEMPLATES_DIR'] = __dir__.'/Templates';

// Twig cacheing disabled if set to false
$GLOBALS['TWIG_CACHE_DIR'] = false;//__dir__.'/Templates/CompilationCache';

// Admin Details
$GLOBALS['ADMIN_PASSWORD_RESET_VALID_FOR'] = 1800; // in seconds
// SMTP
$GLOBALS['PHPMAILER_LOCATION'] = '';
$GLOBALS['ADMIN_EMAIL_HOST'] = '';
$GLOBALS['ADMIN_EMAIL_HOST_PORT'] = '';
$GLOBALS['ADMIN_EMAIL'] = '';
$GLOBALS['ADMIN_EMAIL_PASSWORD'] = '';
$GLOBALS['SMTP_EMAIL_TIMEOUT'] = 20;
$GLOBALS['SMTP_DEBUG_LEVEL'] = 0;

$GLOBALS['MAX_ADMIN_SESSION_INACTIVITY'] = 1800; //In seconds

// URI Routing Settings
$GLOBALS['URI_NODE_JSON_PATH'] = __dir__.'/Routing/RoutingNodes.json';

// Location of static dirs
$GLOBALS['STATIC_DIR'] = __dir__.'/Static';
$GLOBALS['CSS_STATIC_DIR'] = $GLOBALS['STATIC_DIR'].'/css';
$GLOBALS['JS_STATIC_DIR'] = $GLOBALS['STATIC_DIR'].'/js';
$GLOBALS['MEDIA_DIR'] = $GLOBALS['STATIC_DIR'].'/Media';
$GLOBALS['BLOG_POST_MEDIA_DIR'] = $GLOBALS['MEDIA_DIR'].'/BlogPosts';

// location of admin static dirs
$GLOBALS['ADMIN_STATIC_DIR'] = $GLOBALS['STATIC_DIR'].'/admin';
$GLOBALS['ADMIN_CSS_DIR'] = $GLOBALS['ADMIN_STATIC_DIR'].'/css';
$GLOBALS['ADMIN_JS_DIR'] = $GLOBALS['ADMIN_STATIC_DIR'].'/js';
