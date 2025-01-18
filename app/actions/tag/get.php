<?php

require_once __DIR__ . '/../../classes/tag.php';


class getTag {
    static function getAllTags(){
        $tags = Tag::getAll();
        return $tags;
    }
}
?>