<?php

require_once __dir__.'/../Repo/UserDetails/UserDetailsService.php';
require_once __dir__.'/../Classes/User.php';

$detailsService = new UserDetails\UserDetailsService();
$details = $detailsService->fetchUserDetailsByEmail("philtebbutt@hotmail.com");

$user = new User($details);
/*
// test set password
$user->setPassword("hellothisisapassword");
var_dump($user);

// test  check passwords
$matchNo = $user->checkPassword("hellothisisapddassword");
var_dump($matchNo);
$matchYes = $user->checkPassword("hellothisisapassword");
var_dump($matchYes);
*/
// test save user
//$user->setEmailAddress("philtebbutt@hotmail.com");
$user->getUserDetails()->setIsAdmin(true);

//var_dump($user);
$detailsService->saveUserDetails($user->getUserDetails());
