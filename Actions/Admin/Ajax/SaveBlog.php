<?php

require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';
require_once __dir__.'/../../../Repo/BlogPost/BlogPostService.php';
require_once __dir__.'/../../../Classes/BlogPost.php';

class SaveBlog {

    const UNSAVED_STATUS = "UNSAVED";
    const SAVE_SUCCESSFUL_STATUS = "SAVED";
    const SAVE_FAILED_STATUS = "SAVE_FAILED";

    // The below function is horribly written. get it working then tidy one day so that it looks nice
    static function go() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();

        $saveStatus = "UNSAVED";

        $blogPostId = 0;
        $data = json_decode(file_get_contents("php://input"));
        $isNew = $data->isNew;
        $blogPostId = $data->blogId;

        $datePosted = DateTime::createFromFormat('Y-m-d', $data->publishingDate);
        if($data->publishingDate == "") {
            $datePosted = null;
        }

        $blogPostService = new BlogPost\BlogPostService();
        $blogPost = new BlogPost();

        if ($isNew == false) {
            $blogPost->setBlogPostEntity($blogPostService->fetchBlogPostById($blogPostId));
        }

        $blogPost->setSlug($data->slug);
        if ($datePosted != null) {
            $blogPost->setDatePosted($datePosted->format('Y-m-d'));
        } else {
            $blogPost->setDatePosted($datePosted);
        }


        if ($data->publish == false) {
            $data->publish = 0;
        }
        $blogPost->setIsPublished($data->publish);
        $blogPost->setTitle($data->title);
        $blogPost->setBlogDescription($data->blogDescription);
        $blogPost->setBlogText($data->blogContents);

        if($isNew == true) {
            try {
                $blogPostId = $blogPostService->insertNewBlogPost($blogPost);
                $blogPost->setId($blogPostId);
                $saveStatus = static::SAVE_SUCCESSFUL_STATUS;
            } catch(Exception $e) {
                $saveStatus = static::SAVE_FAILED_STATUS;
                echo $e;
            }
        } else {
            $blogPostId = $blogPostService->updateBlogPost($blogPost);
            $saveStatus = static::SAVE_SUCCESSFUL_STATUS;
        }

        $blogSaveHash = "";
        if ($saveStatus == static::SAVE_SUCCESSFUL_STATUS) {
            $blogSaveHash = $blogPost->computeHash();
        }


        // ResponseArray
        $ResponseArray = array(
            'blog_id' => $blogPostId,
            'save_status' => $saveStatus,
            'hash' => $blogSaveHash,
        );

        return json_encode($ResponseArray);
    }

}
