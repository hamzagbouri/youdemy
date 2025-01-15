<?php
require_once __DIR__ . '/../../classes/tag.php';
require_once __DIR__ . '/../../classes/database.php';

    $q = $_GET['query'];
  $tags = Tag::searchTag($q);
  echo json_encode($tags);

?>