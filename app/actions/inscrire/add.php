<?php
require_once __DIR__ . '/../../classes/etudiant.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['idCours']))
{
    $idEtd = $_SESSION['logged_id'];
    $idCours = trim(htmlspecialchars($_GET['idCours']));
    Etudiant::joinCourse($idEtd,$idCours);
    header('Location: ../../../public/etudiant/cours.php');
}
?>