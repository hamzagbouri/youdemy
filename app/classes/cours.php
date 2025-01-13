<?php
require_once 'database.php';
require_once 'coursInterface.php';
  class cours implements coursInterface {
    private $id;
    private $titre;
    private $description;
    private $id_categorie;
    private $image_path;
    private $contenue;
    

    

    public function __construct($id,$titre, $description, $id_categorie,$image_path,$contenue) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->id_categorie = $id_categorie;
        $this->image_path = $image_path;
        $this->contenue = $contenue;
    }

    public function ajouter(){
        $pdo = Database::getInstance()->getConnection();

    }
    public function afficher(){
        $db = Database::getInstance()->getConnection();
    }




    public function supprimer($id){
        try {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM cours where id = :id");
        $stmt->bindParam(':id',$id);
        $res =  $stmt->execute();
        if($res)
        {
            return 202;
        }
        else {
            return false;
        }
    }catch (Exception $e)
    {
        return "Error Deleting Course ". $e->getMessage();
    }
    
    }

 }
?>