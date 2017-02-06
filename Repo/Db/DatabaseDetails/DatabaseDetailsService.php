<?php

namespace DatabaseDetails;

require_once 'Repository.php';
require_once 'Entity.php';

class DatabaseDetailsService {

    private $repository = null;

    function __construct() {
        $this->repository = new Repository();
    }

    function fetchDefaultDetails() {
        return $this->repository->fetchDefaultDetails();
    }
}
