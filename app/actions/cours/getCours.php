<?php

require_once __DIR__ . '/../../classes/Cours.php';

class getCours{
    static function getAll()
    {
        return Cours::afficherTous();
    }
    static function getAllAdmin()
    {
        return Cours::afficherTousAdmin();
    }
    static function getAllByTeacher($id)
    {   
        return Cours::afficherTousParProf($id);
    }
    static function getTwo()
    {
        return Cours::afficherDeux();
    }
    static function getCoursPagination($start)
    {
        return Cours::afficherCoursPagination($start);
    }
    static function totalCours()
    {
        return Cours::totalCours();
    }
    static function searchCours($data){
        return Cours::searchCours($data);
    }
    static function getById($id)
    {
        return Cours::afficherParId($id);
    }
    static function getByIdProf($id)
    {
        return Cours::afficherParIdProf($id);
    }
    static function getAllByStudent($idS)
    {
        return Cours::afficherTousParEtudiant($idS);
    }
   

  
}
