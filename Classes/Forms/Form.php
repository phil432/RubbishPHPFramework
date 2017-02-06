<?php

class Form {
    private $formArray = array();

    function __construct($formArray) {
        $this->formArray = $formArray;
    }

    function cleanFormArray() {
        foreach($this->formArray as $formArrayItem) {
            // html decode all thingys when i get round to it
        }
    }
}
