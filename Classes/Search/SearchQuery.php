<?php

require_once __dir__.'/../Database.php';
require_once __dir__.'/../JsonFactories/BlogPostJsonFactory.php';

class SearchQuery {
    private $queryString;
    private $published;
    private $deepSearch;
    private $publishedFrom;
    private $publishedTo;
    private $createdFrom;
    private $createdTo;

    private $dbConnection;

    public function __construct($dataString) {
        $data = json_decode($dataString);
        @$this->queryString = $data->queryString;
        @$this->published = $this->getBoolFromData($data->published);
        @$this->deepSearch = $data->deepSearch;
        @$this->publishedFrom = $this->formatDateFromData($data->publishedFrom);
        @$this->publishedTo = $this->formatDateFromData($data->publishedTo);
        @$this->createdFrom = $this->formatDateFromData($data->createdFrom);
        @$this->createdTo = $this->formatDateFromData($data->createdTo);

        $this->dbConnection = new Database();
    }

    private function getBoolFromData($boolString) {
        $bool = false;
        if ($boolString == 'on') {
            $bool = true;
        }
        return $bool;
    }

    private function formatDateFromData($dateString) {
        $formattedDate = null;
        if ($dateString != "") {
            $formattedDate = DateTime::createFromFormat('Y-m-d', $dateString);
        }
        return $formattedDate;
    }

    private function formatDateToDatabase($date) {
        $dateString = null;
        if ($date != null) {
            $dateString = $date->format('Y-m-d H:i:s');
        }
        return $dateString;
    }

    // all below is simple for now. only as good as I need it. improve as necessary
    public function go() {
        $result = $this->buildAndRunSearch();
        return BlogPostJsonFactory::fetchJsonFromBlogPostSearchResult($result);
    }

    private function buildAndRunSearch() {
        $searchSQL = "SELECT blog_post.id, blog_post.created, blog_post.published,
                blog_post.posted, blog_post.updated, blog_post.title, blog_post.slug,
                blog_post_text.short_description
                FROM blog_post ";
        $paramsArray = array();
        $searchSQL .= "INNER JOIN blog_post_text ON blog_post_text.id = blog_post.blog_text_id ";
        $searchSQL .= "WHERE blog_post.title LIKE ? ";
        $paramsArray[] = "%".$this->queryString."%";
        if ($this->published) {
            $searchSQL .= "AND blog_post.published = ? ";
            $paramsArray[] = $this->published;
        }
        if ($this->createdFrom) {
            $searchSQL .= "AND created > ? ";
            $paramsArray[] = $this->formatDateToDatabase($this->createdFrom);
        }
        if ($this->createdTo) {
            $searchSQL .= "AND created < ? ";
            $paramsArray[] = $this->formatDateToDatabase($this->createdTo);
        }
        if ($this->publishedFrom) {
            $searchSQL .= "AND posted > ? ";
            $paramsArray[] = $this->formatDateToDatabase($this->publishedFrom);
        }
        if ($this->publishedTo) {
            $searchSQL .= "AND posted < ? ";
            $paramsArray[] = $this->formatDateToDatabase($this->publishedTo);
        }
        $searchSQL .= "ORDER BY created";
        $result = $this->dbConnection->query($searchSQL, $paramsArray);
        return $result;
    }
}
