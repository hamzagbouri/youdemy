<?php
session_start();
require_once 'database.php';

class User {
    protected $id;
    protected $nom;
    protected $email;
    protected $password;
    protected $role;
    protected $banned;

    public function __construct($id, $nom, $email, $password, $role, $banned = 0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->banned = $banned;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function isBanned() {
        return $this->banned;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setBanned($banned) {
        $this->banned = $banned;
    }

    public static function login($email, $password) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
       
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            if (password_verify($password, $res['password'])) {
                if ($res['role'] == 'enseignant') {
                    $user = new Enseignant($res['id'], $res['fullName'], $res['email'], $res['password'], $res['role'],$res['banned'], $res['active']);
                   
                } elseif ($res['role'] == 'etudiant') {
                  $user = new Etudiant($res['id'], $res['fullName'], $res['email'], $res['password'], $res['role'],$res['banned']);
                }
                $_SESSION['logged_id'] = $user->getId();
                $_SESSION['role'] = $user->getRole();
                return $user;
             
            } else {
                return 403;
            }
        }
        return false;
    }

    public function __toString() {
        return 'role ' . $this->role;
    }
    public static function logout(){
        unset($_SESSION['user']);
        
        session_destroy();
       
      
    }
}
?>
