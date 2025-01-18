<?php
require_once __DIR__ . '/../../classes/categorie.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $nom = trim(htmlspecialchars($_POST['nom-category']));
        $category = new Categorie(null,$nom);
        $res = $category->ajouter();
        if($res == 202)
        {
            
        }
        else {
            echo "couldn't add Category";
        }

    } else if (isset($_POST['edit']))
    {
        $id = trim(htmlspecialchars($_POST['id-category-edit']));
        $nom = trim(htmlspecialchars($_POST['nom-category-edit']));
        $category = new Categorie($id,$nom);
        $category->mettreAJour();
        


    }

    header('Location: ../../../public/admin/category.php');

   
} else if (isset($_GET['delete'])){
    
    $id = trim(htmlspecialchars($_GET['delete']));
    
    $res=Categorie::supprimer($id);
  
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
header('Location: ../../../public/admin/category.php');

?>