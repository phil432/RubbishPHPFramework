<?php

namespace BlogPost;

require_once __dir__.'/../../../Classes/Database.php';
require_once __dir__.'/../../../Config.php';

class Db {

    private $connection;

    function __construct() {
        $this->connection = new \Database();
    }

    function insertNewBlogPost($entity) {
        $queryBlogTextInsert = "INSERT INTO blog_post_text
                (short_description, blog_text) VALUES (?, ?)";
        $this->connection->query($queryBlogTextInsert, array($entity->getShortDescription(), $entity->getBlogText()));
        $blogTextId = $this->connection->lastInsertId();

        $queryBlogInsert = "INSERT INTO blog_post
                (posted, title, blog_text_id, published, slug)
                VALUES (?, ?, ?, ?, ?)";
        $this->connection->query($queryBlogInsert,
                array(
                    $entity->getDatePosted(),
                    $entity->getTitle(),
                    $blogTextId,
                    $entity->getIsPublished(),
                    $entity->getSlug()
                )
            );

        // return id of blog_post entry
        return $this->connection->lastInsertId();
    }

    function deleteBlogById($id) {
        $queryFetchBlogTextId = "SELECT blog_text_id FROM blog_post WHERE id = ?";
        $blogTextId = $this->connection->query($queryFetchBlogTextId, array($id));
        $blogTextId = $blogTextId[0]['blog_text_id'];

        $queryDeleteBlogPost = "DELETE FROM blog_post WHERE id = ?";
        $queryDeleteBlogText = "DELETE FROM blog_post_text WHERE id = ?";

        $this->connection->query($queryDeleteBlogPost, array($id));
        $this->connection->query($queryDeleteBlogText, array($blogTextId));
    }

    function fetchAllBlogPosts() {
        $query = "SELECT blog_post.id, created, posted, updated, published, slug,
                title, blog_text_id, short_description, blog_text
                FROM blog_post
                INNER JOIN blog_post_text
                ON blog_post.blog_text_id = blog_post_text.id";
        return $this->connection->query($query, array());
    }

    function fetchAllPublished() {
        $query = "SELECT blog_post.id, created, posted, updated, published, slug,
                title, blog_text_id, short_description, blog_text
                FROM blog_post
                INNER JOIN blog_post_text
                ON blog_post.blog_text_id = blog_post_text.id
                WHERE published = 1
                AND posted NOT LIKE ''";
        return $this->connection->query($query, array());
    }

    function fetchBlogPostById($id) {
        $query = "SELECT blog_post.id, created, posted, updated, published, slug,
                title, blog_text_id, short_description, blog_text
                FROM blog_post
                INNER JOIN blog_post_text
                ON blog_post.blog_text_id = blog_post_text.id
                WHERE blog_post.id = ?";
        $result = $this->connection->query($query, array($id));
        return $result;
    }

    function fetchBlogPostBySlug($slug) {
        $query = "SELECT blog_post.id, created, posted, updated, published, slug,
                title, blog_text_id, short_description, blog_text
                FROM blog_post
                INNER JOIN blog_post_text
                ON blog_post.blog_text_id = blog_post_text.id
                WHERE blog_post.slug = ?";
        $result = $this->connection->query($query, array($id));
        return $result;
    }

    function updateBlogPost($entity) {
        // Update blog text first
        $queryBlogTextUpdate = "UPDATE blog_post_text SET
                short_description = ?, blog_text = ? WHERE id = ?";
        $updateBlogTextParams = array(
                $entity->getShortDescription(),
                $entity->getBlogText(),
                $entity->getBlogTextId()
            );

        $this->connection->query($queryBlogTextUpdate, $updateBlogTextParams);

        // Now update the blog post entry
        $queryBlogUpdate = "UPDATE blog_post SET
                posted = ?, updated = ?, title = ?, published = ?, slug = ?
                WHERE id = ?";

        $this->connection->query($queryBlogUpdate, array(
                $entity->getDatePosted(),
                $entity->getLastUpdated(),
                $entity->getTitle(),
                $entity->getIsPublished(),
                $entity->getSlug(),
                $entity->getId())
            );
        return $entity->getId();
    }

    function getBlogTextIdFromBlog() {
        $query = "SELECT blog_text_id FROM blog_post WHERE id = ?";

    }

}
