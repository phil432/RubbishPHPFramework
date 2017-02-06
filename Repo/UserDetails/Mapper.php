<?php

namespace UserDetails;

require_once 'Entity.php';

class Mapper {

    public static function fromArray($array)
    {
        $entity = new Entity(
            $array['id'],
            $array['nickname'],
            $array['email_address'],
            $array['password_hash'],
            $array['is_admin']
        );
        return $entity;
    }

    public static function toArray($entity)
    {
        $array = array(
            'id' => $entity->getId(),
            'nickname' => $entity->getNickname(),
            'email_address' => $entity->getEmailAddress(),
            'password_hash' => $entity->getPasswordHash(),
            'is_admin' => $entity->getIsAdmin()
        );
        return $array;
    }

}
