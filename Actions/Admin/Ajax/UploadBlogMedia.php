<?php

require_once __dir__.'/../../../Classes/MediaUpload.php';

class UploadBlogMedia {

    static function go() {

        checkIfLoggedInAndRedirectIfNot();
        $data = file_get_contents("php://input");
        $blogId = $_POST['blog_id'];
        $file = $_FILES['upload_file'];
        $mediaUpload = new MediaUpload($blogId);
        $filePath = $mediaUpload->writeToFile($file);
        $fileUrl = UploadBlogMedia::fetchUrlFromPath($filePath);
        return $fileUrl;
    }

    static function fetchUrlFromPath($path) {
        //fetch blog post static url
        $dir = '/Static/Media/BlogPosts/';
        $pathArray = explode($dir, $path);
        $mediaUrlEnd = $pathArray[1];
        $fullUrl = $GLOBALS['HOST_WEB_ADDRESS']."/static-media-blogpost/".$mediaUrlEnd;
        return $fullUrl;
    }
}
