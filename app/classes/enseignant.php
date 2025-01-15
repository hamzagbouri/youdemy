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
    public static function isActive($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * from user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Enseignant($res['id'],$res['fullName'],$res['email'],null,$res['role'],$res['banned'],$res['active']);
    }
    public function getActive()
    {
        return $this->active;
    }
}

?>