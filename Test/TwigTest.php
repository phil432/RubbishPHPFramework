<?php

require_once __dir__.'/../Classes/TemplateLoader.php';

$loader = new TemplateLoader();

$loader->loadTemplate('TestTemplate.html');
$data = array('content' => 'hello!!!!!');

echo $loader->render($data);
