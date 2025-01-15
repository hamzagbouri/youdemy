<?php

require_once __DIR__ . '/../../classes/categorie.php';
require_once __DIR__ . '/../../classes/database.php';

class getCategory {
    static function getAllCategories(){
        $categories = Categorie::getAll();
        return $categories;
    }
}
?>