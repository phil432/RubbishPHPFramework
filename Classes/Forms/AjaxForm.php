<?php

class AjaxForm {
    private $formArray;

    function __construct($formArray) {
        $this->formArray = $formArray;
    }

    function getForm() {
        return $this->formArray;
    }
}
