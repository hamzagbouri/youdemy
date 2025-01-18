<?php
require_once 'User.php';

class Admin extends User {
    public function __construct($id, $fullName, $email, $password = null, $banned = 0) {
        parent::__construct($id, $fullName, $email, $password, 'admin', $banned);
    }
}
?>