<?php
require_once 'cours.php';
require_once 'database.php';
class coursTexte extends Cours{

    public function __construct($id = null, $titre = null, $description = null, $id_categorie = null, $image_path = null, $contenue = null,$type=null) {
        parent::__construct($id,$titre,$description,$id_categorie,$image_path,$contenue,$type);
    }
     public  function ajouter()
    {
        $type = 'texte';
        $this->setType($type);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Cours (titre, description, categorie_id, image_path, contenue,contenue_type) VALUES (:titre, :description, :id_categorie, :image_path, :contenue,:type)");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':image_path', $this->image_path);
        $stmt->bindParam(':contenue', $this->contenue);
        $stmt->bindParam(':type', $this->type);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
        
    }

     public static function afficherCoursParId($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("SELECT * FROM Cours where id = :id");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $coursTexte = new coursTexte($row['id'], $row['titre'], $row['description'], $row['id_categorie'], $row['image_path'], $row['contenue'],$result['type']);
        return $coursTexte;
    }
}
?>