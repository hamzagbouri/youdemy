<?php
require_once __DIR__ . '/User.php';
require_once 'traitSignup.php';
class Enseignant extends User {
    use traitSignup; 

    protected $active;

    public function __construct($id=null, $nom, $email, $password, $role,$banned = 0, $active = 0) {
        parent::__construct($id,$nom, $email, $password, $role,$banned);
        $this->active = $active;
    }

    public static function setActive($id,$active) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE user SET active = :active WHERE id = :id");
        $stmt->bindParam(':active', $active);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public  function isActive()
    {
        return $this->active;
    }
    public function getActive()
    {
        return $this->active;
    }
    public static function totalInscription($id)
    {
        try {
            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("SELECT u.fullName, COUNT(e.id) AS totalInscriptions FROM etudiant_cours e INNER JOIN cours c ON c.id = e.cours_id INNER JOIN user u ON c.enseignant_id = u.id where enseignant_id= :id GROUP BY c.enseignant_id ORDER BY totalInscriptions DESC;");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 401;
        }
    }
    public static function totalCours($id)
    {
        try {
            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("SELECT count(*) as totalCours from cours where enseignant_id = :id group by enseignant_id;");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 401;
        }
    }

}

?>