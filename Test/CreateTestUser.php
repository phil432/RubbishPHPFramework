<?php

require_once __dir__.'/../Classes/AddNewUser.php';

$newUser = new AddNewUser();

$newUser->go(
    'Phil',
    'philtebbutt@hotmail.com',
    'poopoo123',
    true
    );
