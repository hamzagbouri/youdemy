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

    public static function login($email, $password) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            if (password_verify($password, $res['password'])) {
                if ($res['role'] == 'enseignant') {
                    
                    $_SESSION['user'] =  new Enseignant($res['id'], $res['fullName'], $res['email'], $res['password'], $res['role'], $res['active']);
                } elseif ($res['role'] == 'etudiant') {
                    $_SESSION['user'] = new Etudiant($res['id'], $res['fullName'], $res['email'], $res['password'], $res['role']);
                }
                return true;
            } else return 'Invalid Password';
        }
        return false; 
    }
    public function __tostring()
    {
        return 'role '.$this->role; 
    }
}

?>