<?php

require_once __dir__.'/../Classes/Search/SearchQuery.php';
require_once __dir__.'/../Repo/BlogPost/Collection.php';
require_once __dir__.'/../Classes/JsonFactories/BlogPostJsonFactory.php';

$queryString = '{"queryString":"you what mate","published":"off","deepSearch":"on","createdFrom":"2016-02-01","createdTo":"2016-02-16"}';

$data = json_decode($queryString);

$query = new SearchQuery($data);

$result = $query->go();
echo $result;
//echo $result;
//echo BlogPostJsonFactory::fetchJsonFromBlogPostSearchResult($result);
