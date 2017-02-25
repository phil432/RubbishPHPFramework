<?php

require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';
require_once __dir__.'/../../../Repo/BlogPost/BlogPostService.php';

class DeleteBlog {
    const BLOG_DELETED_MESSAGE = "DELETED";

    static function go() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $blogPostId = 0;

        $data = json_decode(file_get_contents("php://input"));

        $blogPostId = $data->blogId;
        $blogPostService = new BlogPost\BlogPostService();
        $blogPostService->deleteBlogById($blogPostId);

        return static::BLOG_DELETED_MESSAGE;
    }
}
