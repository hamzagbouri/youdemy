<?php
require_once 'cours.php';
require_once 'database.php';
class coursTexte extends Cours{
    private $contenue;

    public function __construct($id = null, $titre, $description = null, $id_categorie = null, $image_path = null,$enseignant_id=null, $contenue = null,$type=null) {
        parent::__construct($id,$titre,$description,$id_categorie,$image_path,$enseignant_id,$type);
        $this->contenue = $contenue;
    }
     public  function ajouter()
    {
        $type = 'texte';
        $this->setType($type);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Cours (titre, description, categorie_id, image_path, contenu,contenu_type,enseignant_id) VALUES (:titre, :description, :id_categorie, :image_path, :contenue,:type,:enseignant_id)");

        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id_categorie', $this->id_categorie,PDO::PARAM_INT);
        $stmt->bindParam(':image_path', $this->image_path);
        $stmt->bindParam(':enseignant_id', $this->enseignant_id,PDO::PARAM_INT);
        $stmt->bindParam(':contenue', $this->contenue);
        $stmt->bindParam(':type', $this->type);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
        
    }
    
    public function mettreAJour() {
        $sql = "UPDATE cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                enseignant_id = :enseignant_id, contenu = :contenu WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'contenu' => $this->contenu,
            'id' => $this->id
        ]);
    }
    public function afficherCours() {
        return "<p> ".$this->contenu." </p>";
    }

     
    public function getContenue() {
        return $this->contenue;
    }
    
    public function setContenue($contenue) {
        return $this->contenue;
    }
}
?>