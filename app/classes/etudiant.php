<?php
require_once 'traitSignup.php';
require_once __DIR__ . '/User.php';

class Etudiant extends User {
    use traitSignup; 

    public function __construct($id, $nom, $email, $password, $role, $banned = 0) {
        parent::__construct($id, $nom, $email, $password, $role, $banned);
    }

    
    public function joinCourse($coursId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO etudiant_cours (etudiant_id, cours_id) VALUES (:etudiantId, :coursId)");
        $stmt->bindParam(':etudiantId', $this->id);
        $stmt->bindParam(':coursId', $coursId);
        return $stmt->execute();
    }

   
    public function myCourses() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT c.* FROM courses c JOIN etudiant_cours ec ON c.id = ec.cours_id WHERE ec.etudiant_id = :etudiantId");
        $stmt->bindParam(':etudiantId', $this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>