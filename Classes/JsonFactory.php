<?php

class JsonFactory {

    private $dataArray;

    function toJson() {
        return json_encode($this->getDataArray());
    }

    function setDataArray($dataArray) {
        $this->dataArray = $dataArray;
    }

    function getDataArray() {
        return $this->dataArray;
    }
}
