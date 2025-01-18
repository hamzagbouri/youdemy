<?php

require_once __DIR__ . '/../../classes/User.php';
require_once __DIR__ . '/../../classes/enseignant.php';
require_once __DIR__ . '/../../classes/etudiant.php';
require_once __DIR__ . '/../../classes/admin.php';


class CoursEtudiant {
    static function checkInscription($idC,$idEtd){
        $count = Etudiant::checkCourse($idEtd,$idC);
        return $count;
    }
}
?>