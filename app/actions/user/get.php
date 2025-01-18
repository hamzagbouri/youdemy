<?php

require_once __DIR__ . '/../../classes/User.php';
require_once __DIR__ . '/../../classes/enseignant.php';
require_once __DIR__ . '/../../classes/etudiant.php';
require_once __DIR__ . '/../../classes/admin.php';


class getUser {
    static function getAllUsers(){
        $users = User::afficherTout();
        return $users;
    }
}
?>