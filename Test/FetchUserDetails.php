<?php

require_once __dir__.'/../Repo/UserDetails/UserDetailsService.php';
$detailsService = new UserDetails\UserDetailsService();
$details = $detailsService->fetchUserDetailsById(1);
var_dump($details);
