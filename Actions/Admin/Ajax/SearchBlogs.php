<?php

require_once __dir__.'/../../../Utils/Admin/AdminUtils.php';
require_once __dir__.'/../../../Utils/Functions.php';
require_once __dir__.'/../../../Repo/BlogPost/BlogPostService.php';
require_once __dir__.'/../../../Classes/BlogPost.php';
require_once __dir__.'/../../../Classes/Search/SearchQuery.php';
require_once __dir__.'/../../../Repo/BlogPost/Collection.php';
require_once __dir__.'/../../../Classes/JsonFactories/BlogPostJsonFactory.php';

class SearchBlogs {

    static function go() {
        session_start();
        checkIfLoggedInAndRedirectIfNot();
        $data = file_get_contents("php://input");
        $query = new SearchQuery($data);
        return $query->go();
    }
}
