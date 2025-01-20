<?php
require_once __DIR__ . '/../../classes/cours.php';
require_once __DIR__ . '/../../classes/database.php';

    $idC = $_GET['coursId'];
    $cours = Cours::getAllJson($idC);
  echo json_encode($cours);

?>