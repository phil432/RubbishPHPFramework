<?php

namespace PasswordReset;

require_once 'PasswordReset.php';
require_once 'Db.php';
require_once __dir__.'/../../Utils/Functions.php';

class PasswordResetService {

    public function createNewPasswordReset($userId) {
        $passwordReset = new PasswordReset();
        $passwordReset->setUserId($userId);
        $passwordReset->setUrlCode(getToken(40));

        // save it in the db
        $db = new Db();
        $db->insetNewPasswordReset($passwordReset);

        return $this->fetchPasswordResetByUrlCode($passwordReset->getUrlCode());
    }

    public function fetchPasswordResetByUrlCode($urlCode)
    {
        $db = new Db();
        $results = $db->fetchPasswordResetByUrlCode($urlCode);
        return $this->createInstanceFromDbResults($results);
    }

    public function deleteAllPasswordResetsByUserId($userId)
    {
        $db = new Db();
        $db->deleteAllPasswordResetsByUserId($userId);
    }

    private function createInstanceFromDbResults($passwordResetDetails)
    {
        $passwordReset = new PasswordReset();

        if (sizeof($passwordResetDetails) == 1) {
            $passwordResetDetails = $passwordResetDetails[0];
            // convert date created string to DateTime
            $dateCreated = \DateTime::createFromFormat('Y-m-d H:i:s', $passwordResetDetails['date_created']);
            // do the rest of the stuff
            $passwordReset->setUrlCode($passwordResetDetails['url_code']);
            $passwordReset->setUserId($passwordResetDetails['user_id']);
            $passwordReset->setDateCreated($dateCreated);
        }
        return $passwordReset;
    }

}
