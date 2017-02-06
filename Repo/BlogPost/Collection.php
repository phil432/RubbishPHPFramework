<?php

namespace BlogPost;

require_once 'Entity.php';
require_once 'Mapper.php';

class Collection {

    private $collectionArray = array();

    public function setCollectionArrayFromDbArray($dbArray) {
        foreach($dbArray as $result) {
            $newEntity = Mapper::fromArray($result);
            $this->collectionArray[] = $newEntity;
        }
    }

    public function setCollectionArray($collectionArray) {
        $this->collectionArray = $collectionArray;
    }

    public function addToCollectionArray($entity) {
        $this->collectionArray[] = $entity;
    }

    public function fetchSimpleArray() {
        $simpleArray = array();
        foreach ($this->collectionArray as $entity) {
            $simpleArray[] = Mapper::toArray($entity);
        }
        return $simpleArray;
    }
}
