<?php

require_once __dir__.'/../Classes/MediaUpload.php';

$mediaUpload = new MediaUpload(2);

$mediaUpload->createDirIfNotExists();
