<?php

namespace BlogPost;

require_once __dir__.'/Storage/Db.php';
require_once __dir__.'/Collection.php';
require_once __dir__.'/Mapper.php';

class Repository {

    private $db;

    function __construct() {
        $this->db = new Db();
    }

    function insertNewBlogPost($entity) {
        return $this->db->insertNewBlogPost($entity);
    }

    function fetchBlogPostById($id) {
        $result = $this->db->fetchBlogPostById($id);
        return Mapper::fromArray($result[0]);
    }

    function fetchBlogPostBySlug($slug) {
        $result = $this->db->fetchBlogPostBySlug($slug);
        return Mapper::fromArray($result[0]);
    }

    function fetchBlogPostByPostedDateRange() {
        return "not implemented yet";
    }

    function fetchAllBlogPosts() {
        $results = $this->db->fetchAllBlogPosts();
        $collection = new Collection();
        foreach ($results as $result) {
            $entity = Mapper::fromArray($result);
            $collection->addToCollectionArray($entity);
        }
        return $collection;
    }

    function fetchAllPublished() {
        $results = $this->db->fetchAllPublished();
        $collection = new Collection();
        foreach ($results as $result) {
            $entity = Mapper::fromArray($result);
            $collection->addToCollectionArray($entity);
        }
        return $collection;
    }

    function updateBlogPost($entity) {
        return $this->db->updateBlogPost($entity);
    }

    function deleteBlogById($id) {
        $this->db->deleteBlogById($id);
    }

}
