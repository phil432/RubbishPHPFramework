<?php

namespace BlogPost;

require_once 'Repository.php';

class BlogPostService {

    private $repository;

    function __construct() {
        $this->repository = new Repository();
    }

    function insertNewBlogPost($blogPost) {
        $entity = $blogPost->getBlogPostEntity();
        return $this->repository->insertNewBlogPost($entity);
    }

    function fetchBlogPostById($id) {
        return $this->repository->fetchBlogPostById($id);
    }

    function fetchAllBlogPosts() {
        return $this->repository->fetchAllBlogPosts();
    }

    function updateBlogPost($blogPost) {
        $entity = $blogPost->getBlogPostEntity();
        return $this->repository->updateBlogPost($entity);
    }

    function deleteBlogById($id) {
        $this->repository->deleteBlogById($id);
    }

}
