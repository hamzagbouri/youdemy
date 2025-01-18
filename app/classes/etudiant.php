<?php
require_once 'traitSignup.php';
require_once __DIR__ . '/User.php';

class Etudiant extends User {
    use traitSignup; 

    public function __construct($id, $nom, $email, $password, $role, $banned = 0) {
        parent::__construct($id, $nom, $email, $password, $role, $banned);
    }

    
    public static function joinCourse($idEtd,$coursId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO etudiant_cours (etudiant_id, cours_id) VALUES (:etudiantId, :coursId)");
        $stmt->bindParam(':etudiantId', $idEtd);
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
    public static function checkCourse($idEtd,$coursId)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT Count(*) as totalCoursEtudiant FROM etudiant_cours where cours_id = :cours_id and etudiant_id = :etudiantId");
        $stmt->bindParam(':etudiantId', $idEtd);
        $stmt->bindParam(':cours_id', $coursId);
        $stmt->execute();
        $res =  $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['totalCoursEtudiant'];

    }

}


?>