<?php

require_once __dir__.'/CreateUrlRoutingLibrary.php';
require_once __dir__.'/Actions.php';

$nodeArray = array();

//Add the admin url nodes
$nodeArray[0] = makeNode("/^admin$/", null);
$nodeArray[0][0] = makeNode("/^login$/", DISPLAY_ADMIN_LOGIN_PAGE_ACTION);
$nodeArray[0][1] = makeNode("/^dashboard$/", SHOW_ADMIN_DASHBOARD_ACTION);
$nodeArray[0][1][0] = makeNode("/^blog-edit$/", LOAD_BLOG_EDIT_ACTION);
$nodeArray[0][1][1] = makeNode("/^blog-settings$/", LOAD_BLOG_SETTINGS_ACTION);
$nodeArray[0][2] = makeNode("/^ajax$/", null);
$nodeArray[0][2][0] = makeNode("/^auth-user$/", AJAX_ADMIN_AUTH_USER_ACTION);
$nodeArray[0][2][1] = makeNode("/^save-blog$/", AJAX_ADMIN_SAVE_BLOG_ACTION);
$nodeArray[0][2][2] = makeNode("/^delete-blog$/", AJAX_ADMIN_DELETE_BLOG_ACTION);
$nodeArray[0][2][3] = makeNode("/^search-blogs$/", AJAX_ADMIN_SEARCH_BLOGS);
$nodeArray[0][2][4] = makeNode("/^blog-media-upload$/", AJAX_ADMIN_BLOG_MEDIA_UPLOAD);
$nodeArray[0][2][5] = makeNode("/^logout$/", AJAX_ADMIN_LOGOUT_ACTION);
$nodeArray[0][2][6] = makeNode("/^password-reset-request$/", AJAX_ADMIN_PASSWORD_RESET);
$nodeArray[0][2][7] = makeNode("/^set-new-password$/", AJAX_ADMIN_SET_NEW_PASSWORD);
$nodeArray[0][2][8] = makeNode("/^background-image-upload$/", AJAX_ADMIN_BACKGROUND_IMAGE_UPLOAD);
$nodeArray[0][2][9] = makeNode("/^fetch-all-backgrounds$/", AJAX_ADMIN_FETCH_ALL_BACKGROUNDS);
$nodeArray[0][3] = makeNode("/^components$/", null);
$nodeArray[0][3][0] = makeNode("/^blog-edit-panel$/", LOAD_BLOG_EDIT_PANEL_ACTION);
$nodeArray[0][3][1] = makeNode("/^blog-search-panel$/", BLOG_SEARCH_PANEL_ACTION);
$nodeArray[0][3][2] = makeNode("/^background-image-admin$/", BACKGROUND_IMAGE_ADMIN);
$nodeArray[0][4] = makeNode("/^password-reset$/", PASSWORD_RESET_PAGE_ACTION);
$nodeArray[0][5] = makeNode("/^set-new-password$/", SET_NEW_PASSWORD_PAGE);
$nodeArray[0][5][0] = makeNode("/^[a-zA-Z0-9]{40}$/", SET_NEW_PASSWORD_PAGE);

// Direct static to where it needs to go
$nodeArray[1] = makeNode("/^static$/", FETCH_GENERAL_STATIC_ACTION, true);
$nodeArray[2] = makeNode("/^static-css$/", FETCH_CSS_ACTION, true);
$nodeArray[3] = makeNode("/^static-js$/", FETCH_JS_ACTION, true);
$nodeArray[4] = makeNode("/^static-admin$/", FETCH_ADMIN_STATIC_ACTION, true);
$nodeArray[5] = makeNode("/^static-admin-css$/", FETCH_ADMIN_CSS_ACTION, true);
$nodeArray[6] = makeNode("/^static-admin-js$/", FETCH_ADMIN_JS_ACTION, true);
$nodeArray[7] = makeNode("/^static-media-blogpost$/", FETCH_BLOGPOST_STATIC, true);
$nodeArray[8] = makeNode("/^background-images-location$/", FETCH_BACKGROUND_IMAGES, true);


$nodeArray[9] = makeNode("/^home$/", FETCH_HOME_PAGE);
$nodeArray[10] = makeNode("/^$/", FETCH_COVER_PAGE);
$nodeArray[11] = makeNode("/^article$/", FETCH_ARTICLE_NOT_FOUND);
$nodeArray[11][0] = makeNode("/^[0-9]{1,3}$/", FETCH_ARTICLE_PAGE_BY_ID);
$nodeArray[11][1] = makeNode("/^[a-zA-Z0-9\-]{4,100}$/", FETCH_ARTICLE_PAGE_BY_SLUG);
$nodeArray[12] = makeNode("/^contact$/", FETCH_CONTACT_PAGE);
$nodeArray[13] = makeNode("/^ajax$/", null);
$nodeArray[13][0] = makeNode("/^contact-form$/", CONTACT_FORM_ACTION);
//Put the test action in
//$nodeArray[2] = makeNode("/^test-action$/", TEST_ACTION);

$nodeString = json_encode($nodeArray);

writeToRoutingFile($nodeString);
var_dump($nodeString);
