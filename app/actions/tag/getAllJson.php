<?php
require_once __DIR__ . '/../../classes/tag.php';
require_once __DIR__ . '/../../classes/database.php';
  if(isset($_GET['query'])){
    $q = $_GET['query'];
  $tags = Tag::searchTag($q);
  echo json_encode($tags);}
  if(isset($_GET['coursId']))
  {
    $idC = $_GET['coursId'];
    $tags = Tag::getTagsByCours($idC);
    echo json_encode($tags);
  }

?>