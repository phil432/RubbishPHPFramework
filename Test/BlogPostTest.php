<?php

require_once __dir__.'/../Repo/BlogPost/BlogPostService.php';
require_once __dir__.'/../Classes/BlogPost.php';

$service = new BlogPost\BlogPostService();


// below tests adding a blog post
/*
$blogPost = new BlogPost();
$blogPost->setSlug("hello");
$dt = new DateTime();
$blogPost->setDatePosted($dt->format('Y-m-d'));
$blogPost->setIsPublished(true);
$blogPost->setTitle("hello this is a title");
$blogPost->setBlogDescription("this is a short description");
$blogPost->setBlogText("hello this is a blog you what mate");


$service->insertNewBlogPost($blogPost);
*/

// below tests deleting a blog post
$service->deleteBlogById(26);
