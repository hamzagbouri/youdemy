<?php
require_once 'database.php';

class Categorie {
    private $id;
    private $titre;

    public function __construct($id = null, $titre = null) {
        $this->id = $id;
        $this->titre = $titre;
    }

    public function ajouter() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Categorie (titre) VALUES (:titre)");
        $stmt->bindParam(':titre', $this->titre);
    
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true; 
        } else {
            return false;  
        }
    }

    public static function getById($id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM Categorie WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Categorie($result['id'], $result['titre']);
        }
        return null;
    }


    public static function getAll() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("SELECT * FROM Categorie");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $categories = [];
        foreach ($result as $row) {
            $categories[] = new Categorie($row['id'], $row['titre']);
        }
        return $categories;
    }


    public function mettreAJour() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE Categorie SET titre = :titre WHERE id = :id");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public static function supprimer($id) {
        $pdo = Database::getInstance()->getConnection();
    
        
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE categorie_id = :id");
        $checkStmt->bindParam(':id', $id);
        $checkStmt->execute();
        $count = $checkStmt->fetchColumn();
    
        if ($count > 0) {
            
            return [
                'success' => false,
                'message' => 'Cannot delete category because it is linked to existing courses.'
            ];
        }
    
       
        $stmt = $pdo->prepare("DELETE FROM Categorie WHERE id = :id");
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Category deleted successfully.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to delete category.'
            ];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }
}
?>
