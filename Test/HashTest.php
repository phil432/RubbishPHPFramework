<?php

require_once __dir__.'/../Classes/Hash.php';

$password = "hellothisisapassword";

$hashedPassword = Hasher::hash($password);

echo $hashedPassword;
