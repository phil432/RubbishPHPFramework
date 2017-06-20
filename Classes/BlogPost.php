<?php

require_once __dir__.'/../Repo/BlogPost/BlogPostService.php';
require_once __dir__.'/DateTimeManager.php';
require_once __dir__.'/../Repo/BlogPost/Entity.php';

class BlogPost {

    private $blogPostEntity;

    function __construct($blogPostEntity = null) {
        $this->blogPostEntity = $blogPostEntity;
        if ($blogPostEntity == null) {
            $this->blogPostEntity = new BlogPost\Entity();
        }
    }

    function setBlogPostEntity($entity) {
        $this->blogPostEntity = $entity;
    }

    function getBlogPostEntity() {
        return $this->blogPostEntity;
    }

    function setId($id) {
        $this->blogPostEntity->setId($id);
    }

    function getId() {
        return $this->blogPostEntity->getId();
    }

    function setTitle($title) {
        if ($this->blogPostEntity->getId() != null) {
            $this->setDateUpdated();
        }
        $this->blogPostEntity->setTitle($title);
    }

    function getTitle() {
        return $this->blogPostEntity->getTitle();
    }

    function getBlogText() {
        return $this->blogPostEntity->getBlogText();
    }

    function setBlogText($blogText) {
        if ($this->blogPostEntity->getId() != null) {
            $this->setDateUpdated();
        }
        $this->blogPostEntity->setBlogText($blogText);
    }

    function getDateCreated() {
        $this->blogPostEntity->getDateCreated();
    }

    function getDatePosted() {
        return $this->blogPostEntity->getDatePosted();
    }

    function setDatePosted($date) {
        $this->blogPostEntity->setDatePosted($date);
    }

    function getDateUpdated() {
        $this->blogPostEntity->getLastUpdated();
    }

    function setDateUpdated() {
        $dt = new DateTime();
        $dateUpdated = $dt->format('Y-m-d H:i:s');
        $this->blogPostEntity->setLastUpdated($dateUpdated);
    }

    function getIsPublished() {
        return $this->blogPostEntity->getIsPublished();
    }

    function setIsPublished($isPublished) {
        return $this->blogPostEntity->setIsPublished($isPublished);
    }

    function getBlogDescription() {
        return $this->blogPostEntity->getShortDescription();
    }

    function setBlogDescription($blogDescription) {
        $this->blogPostEntity->setShortDescription($blogDescription);
    }

    function getSlug() {
        return $this->blogPostEntity->getSlug();
    }

    function setSlug($slug) {
        // validate slug being inserted
        $slug = strtolower(urlencode(str_replace(" ", "-", $slug)));
        $this->blogPostEntity->setSlug($slug);
   }

   private function toString() {
       $isNew = true;
       if ($this->blogPostEntity->getId() != 0) {
           $isNew = false;
       }

       $isPublished = true;
       if ($this->getIsPublished() == 0) {
           $isPublished = false;
       }

        $blogArray = array(
           "blogId" => $this->getId(),
           "isNew" => $isNew,
           "publish" => $isPublished, //this->getIsPublished(),
           "publishingDate" => $this->getDatePosted(),
           "slug" => $this->getSlug(),
           "title" => $this->getTitle(),
           "blogDescription" => $this->getBlogDescription(),
           "blogContents" => $this->getBlogText()
       );
       $stringRepr = json_encode($blogArray, JSON_UNESCAPED_SLASHES);
       //echo $stringRepr;
       return $stringRepr;
   }

   function computeHash() {
       // DEBUG
       // echo $this->toString();
       return md5($this->toString());
   }

}
