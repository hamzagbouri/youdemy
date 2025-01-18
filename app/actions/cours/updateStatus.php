<?php
session_start();
require_once __DIR__ . '/../../classes/Cours.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $idCours = $_POST['cours_id'];
    if(isset($_POST['action']))
    {
        $newStatus = $_POST['action'];
        $res = Cours::updateStatus($idCours,$newStatus);
        header("Location: ../../../public/admin/cours.php");
    } 
}
