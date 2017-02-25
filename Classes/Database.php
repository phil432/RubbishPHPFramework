<?php

require_once __dir__.'/../Repo/Db/DatabaseDetails/DatabaseDetailsService.php';

class Database {

    protected $isConnected = false;
    protected $dbDetails = null;
    protected $pdo = null;
    protected $charset = 'utf8';

    function __construct($dbDetails = null)
    {
        $dbDetailsService = new DatabaseDetails\DatabaseDetailsService();
        if ($dbDetails == null) {
            $this->dbDetails = $dbDetailsService->fetchDefaultDetails();
        } else {
            // something here at some point
        }
    }

    function connect()
    {
        if ($this->isConnected == false) {
            try{
                $arg1String = "mysql:host={$this->dbDetails->getHost()};dbname={$this->dbDetails->getName()}";
                $this->isConnected = true;
                $this->pdo = new PDO(
                        $arg1String,
                        $this->dbDetails->getUser(),
                        $this->dbDetails->getPassword(),
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                    );
            } catch(PDOException $e) {
                //One day do something here
                 echo $e->getMessage();
            }
        } else {
            // do nothing
        }
    }

    function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    function disconnect()
    {
        $this->pdo = null;
        $this->isConnected = false;
    }

    function query($query, $paramsArray = array())
    {
        $resultsArray = false;
        $this->connect();
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($paramsArray);
            try {
                $resultsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                // Do nothing here - don't even echo because of annoying non-error
            }
        } catch (PDOException $e) {
            // do something here one day
            echo $e->getMessage();
        }
        return $resultsArray;
    }

}
