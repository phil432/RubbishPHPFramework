<?php

require_once __dir__.'/../Repo/PasswordReset/PasswordResetService.php';

$resetService = new PasswordReset\PasswordResetService();

$testReset = $resetService->createNewPasswordReset(1);

$urlCode = $testReset->getUrlCode();

echo "this is the url code ".$urlCode."n";

$didItWork = $resetService->fetchPasswordResetByUrlCode($urlCode);

var_dump($didItWork);

$resetService->deleteAllPasswordResetsByUserId(1);
