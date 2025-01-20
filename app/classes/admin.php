<?php
require_once 'User.php';

class Admin extends User {
    public function __construct($id, $fullName, $email, $password = null, $banned = 0) {
        parent::__construct($id, $fullName, $email, $password, 'admin', $banned);
    }
    public static function setBan($id, $ban)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE user SET banned = :ban WHERE id = :id");
        $stmt->bindParam(':ban', $ban, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        echo "zdxd ".$ban." ".$id;
        if ($stmt->execute()) {
            return $stmt->execute(); 
        } else {
            return false; 
        }
    }
}
?>