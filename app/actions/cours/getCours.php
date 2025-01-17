<?php
session_start();
require_once __DIR__ . '/../../classes/Cours.php';

class getCours{
    static function getAll()
    {
        return Cours::afficherTous();
    }
    static function getAllByTeacher()
    {   
        $id = trim(htmlspecialchars($_SESSION['logged_id']));
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
   

  
}
