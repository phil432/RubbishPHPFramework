<?php

namespace UserDetails;

require_once __dir__.'/../../../Classes/Database.php';
require_once __dir__.'/../../../Config.php';

class Db {
    private $connection;

    function __construct() {
        $this->connection = new \Database();
    }

    function updateUserById($entity)
    {
        $query = "UPDATE user
            SET nickname = ?, email_address = ?, password_hash = ?
            WHERE id = ?";
        try {
            $this->connection->query(
                $query,
                array(
                        $entity->getNickname(),
                        $entity->getEmailAddress(),
                        $entity->getPasswordHash(),
                        $entity->getId()
                )
            );
        } catch(PDOException $e) {
            // Do something here
            echo $e->getMessage();
        }
        $this->updateUserPermissionById($entity);
    }

    private function updateUserPermissionById($entity) {
        $updatePermissionQuery = "REPLACE INTO user_permission
            (user_id, is_admin) VALUES (?, ?)";

        try {
            $this->connection->query(
                $updatePermissionQuery,
                array($entity->getId(),
                    $entity->getIsAdmin()
                )
            );
        } catch(PDOException $e) {
            // Do something here
            echo $e->getMessage();
        }
    }

    function createUser($entity)
    {
        $query = "INSERT INTO user (nickname, email_address, password_hash) VALUES (?, ?, ?)";
        $this->connection->query(
            $query,
            array(
                    $entity->getNickname(),
                    $entity->getEmailAddress(),
                    $entity->getPasswordHash())
        );
    }

    function fetchUserById($id)
    {
        $query = "SELECT id, nickname, email_address, password_hash, is_admin
                FROM user
                LEFT JOIN user_permission
                ON user.id = user_permission.user_id
                WHERE id = ?";
        $result = $this->connection->query(
            $query,
            array($id)
        );
        return $result;
    }

    function fetchUserByEmail($emailAddress)
    {
        $query = "SELECT id, nickname, email_address, password_hash, is_admin
                FROM user
                LEFT JOIN user_permission
                ON user.id = user_permission.user_id
                WHERE email_address = ?";
        $result = $this->connection->query(
            $query,
            array($emailAddress)
        );
        return $result;
    }
}
