<?php

namespace BlogPost;

require_once 'Entity.php';

class Mapper {

    static function fromArray($array) {
        @$entity = new Entity(
                $array['id'],
                $array['created'],
                $array['posted'],
                $array['updated'],
                $array['title'],
                $array['short_description'],
                $array['blog_text'],
                $array['blog_text_id'],
                $array['published'],
                $array['slug']
        );

        return $entity;
    }

    static function toArray($entity) {
        $array = array(
            'id' => $entity->getId(),
            'created' => $entity->getDateCreated(),
            'posted' => $entity->getDatePosted(),
            'updated' => $entity->getLastUpdated(),
            'title' => $entity->getTitle(),
            'short_description' => $entity->getShortDescription(),
            'blog_text' => $entity->getBlogText(),
            'blog_text_id' => $entity->getBlogTextId(),
            'published' => $entity->getIsPublished(),
            'slug' => $entity->getSlug()
        );

        return $array;
    }

}
