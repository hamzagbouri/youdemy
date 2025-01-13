<?php
require_once 'database.php';

class Tag {
    private $id;
    private $titre;

    public function __construct($id = null, $titre = null) {
        $this->id = $id;
        $this->titre = $titre;
    }

    public function add() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Tag (titre) VALUES (:titre)");
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
        $stmt = $pdo->prepare("SELECT * FROM Tag WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Tag($result['id'], $result['titre']);
        }
        return null;
    }

    public static function getAll() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("SELECT * FROM Tag");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $tags = [];
        foreach ($result as $row) {
            $tags[] = new Tag($row['id'], $row['titre']);
        }
        return $tags;
    }

    public function update() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE Tag SET titre = :titre WHERE id = :id");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public static function delete($id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM Tag WHERE id = :id");
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
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
