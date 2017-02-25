<?php

require_once __dir__.'/../JsonFactory.php';
require_once __dir__.'/../../Repo/BlogPost/BlogPostService.php';
require_once __dir__.'/../../Repo/BlogPost/Mapper.php';
require_once __dir__.'/../../Repo/BlogPost/Collection.php';

class BlogPostJsonFactory extends JsonFactory {

    // not implemented the below function yet
    public function fetchArrayFromBlogPost($blogPost) {

    }

    static function fetchJsonFromBlogPostSearchResult($results) {
        $collection = new blogPost\Collection();
        $collection->setCollectionArrayFromDbArray($results);
        $collectionArray = $collection->fetchSimpleArray();
        return json_encode($collectionArray);
    }
}
