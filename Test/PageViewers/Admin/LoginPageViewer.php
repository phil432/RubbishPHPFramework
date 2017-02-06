<?php

include_once __dir__.'/../../../Classes/TemplateLoader.php';

$loader = new TemplateLoader();
$loader->loadTemplate('Admin/LoginPage.html');
$data = array();
echo $loader->render($data);
