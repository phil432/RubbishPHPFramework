<?php

namespace PasswordReset;

class PasswordReset {
    private $urlCode = "";
    private $userId = null;
    private $dateCreated = null;

    public function setUrlCode($urlCode) {
        $this->urlCode = $urlCode;
    }

    public function getUrlCode() {
        return $this->urlCode;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function checkIsValid()
    {
        $isValid = false;
        if ($this->dateCreated) {
            $dateTimeNow = new \DateTime("now");
            $interval = $dateTimeNow->diff($this->dateCreated);
            if ($interval->s < $GLOBALS['ADMIN_PASSWORD_RESET_VALID_FOR']) {
                $isValid = true;
            }
        }
        return $isValid;
    }

}
