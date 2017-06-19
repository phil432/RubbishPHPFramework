<?php

namespace BlogPost;

class Entity {
    private $id;
    private $dateCreated;
    private $datePosted;
    private $dateLastUpdated;
    private $title;
    private $shortDescription;
    private $blogText;
    private $blogTextId;
    private $isPublished;
    private $slug;

    function __construct(
            $id = 0,
            $dateCreated = null,
            $datePosted = null,
            $dateLastUpdated = null,
            $title = null,
            $shortDescription = null,
            $blogText = null,
            $blogTextId = null,
            $isPublished = null,
            $slug = null) {
        $this->id = $id;
        $this->dateCreated = $dateCreated;
        $this->datePosted = $datePosted;
        $this->dateLastUpdated = $dateLastUpdated;
        $this->title = $title;
        $this->shortDescription = $shortDescription;
        $this->blogText = $blogText;
        $this->blogTextId = $blogTextId;
        $this->isPublished = $isPublished;
        $this->slug = $slug;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getBlogTextId() {
        return $this->blogTextId;
    }

    function setBlogTextId($blogTextId) {
        $this->blogTextId = $blogTextId;
    }

    function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    function getDateCreated() {
        return $this->dateCreated;
    }

    function setDatePosted($datePosted) {
        $this->datePosted = \DateTime::createFromFormat('Y-m-d', $datePosted);
    }

    function getDatePosted() {
        return $this->datePosted;
    }

    function getLastUpdated() {
        return $this->dateLastUpdated;
    }

    function setLastUpdated($dateLastUpdated) {
        $this->dateLastUpdated = $dateLastUpdated;
    }

    function getTitle() {
        return $this->title;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function getBlogText() {
        return $this->blogText;
    }

    function setBlogText($blogText) {
        $this->blogText = $blogText;
    }

    function getShortDescription() {
        return $this->shortDescription;
    }

    function setShortDescription($shortDescription) {
        $this->shortDescription = $shortDescription;
    }

    function getIsPublished() {
        return $this->isPublished;
    }

    function setIsPublished($isPublished) {
        $this->isPublished = $isPublished;
    }

    function getSlug() {
        return $this->slug;
    }

    function setSlug($slug) {
        $this->slug = $slug;
    }

}
