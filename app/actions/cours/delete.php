<?php
session_start();
require_once __DIR__ . '/../../classes/Cours.php';

if(isset($_GET['idCours']))
{
    $idC = trim(htmlspecialchars($_GET['idCours']));
    Cours::supprimer($idC);
    header("Location: ../../../public/cours.php");

  
}
