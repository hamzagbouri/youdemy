<?php
trait traitSignup {
    public static function signup($nom, $email, $password, $role, $active = 1) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false; 
        }

       
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO user (fullName, email, password, role, active, banned) VALUES (:nom, :email, :password, :role, :active, 0)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':active', $active);

        return $stmt->execute(); 
    }
}

?>