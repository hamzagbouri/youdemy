<?php
require_once __DIR__ . '/../../classes/tag.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $tags = ($_POST['tags']);
        foreach($tags as $tag)
        {
            echo $tag;
            $newtag = new Tag(null,$tag);
            $res = $newtag->add();
        }
        
    

    } else if (isset($_POST['edit']))
    {
        $id = trim(htmlspecialchars($_POST['id-category-edit']));
        $nom = trim(htmlspecialchars($_POST['nom-category-edit']));
        $tag = new Tag($id,$nom);
        $tag->update();
        


    }

    header('Location: ../../../public/admin/category.php');

   
} else if (isset($_GET['delete'])){
    
    $id = trim(htmlspecialchars($_GET['delete']));
    
    $res=Tag::delete($id);
  
    if($res['success'])
    {
        $_SESSION['message_type'] = 'success';
    }
    else
    {
        $_SESSION['message_type'] = 'error';
    }
    $_SESSION['message'] = $res['message'];
    

}
header('Location: ../../../public/admin/tags.php');

?>