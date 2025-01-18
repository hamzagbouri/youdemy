<?php
require_once __DIR__.'/../../classes/enseignant.php';
require_once __DIR__.'/../../classes/User.php';
require_once __DIR__.'/../../classes/etudiant.php';
require_once __DIR__.'/../../classes/admin.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
        $email = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format";
            $_SESSION['message_type'] = "error";
            header('Location: ../../../public/login.php');
            exit;
        }
        
        $user = User::login($email, $password);

        if($user === 403)
        {
            $_SESSION['message'] = "Invalid email or password ";
            $_SESSION['message_type'] = "error";
            header('Location: ../../../public/login.php');
        }
        else if ($user) {
            if ($user->isBanned()){
                $_SESSION['message'] = "This User is banned";
                $_SESSION['message_type'] = "error";
                User::logout();
                header('Location: ../../../public/login.php');
            } else {
                if($user->getRole() == 'enseignant')
                {
                    $res = $user->isActive();
                    
                    if($res == 1)
                    {
                       $_SESSION['message'] = "Welcome back ".$user->getNom();
                        $_SESSION['message_type'] = "success";
                        header('Location: ../../../public/index.php'); 
                    } else if($res == 0) {
                        $_SESSION['message'] = "Compte pas encore activé ";
                        $_SESSION['message_type'] = "error";
                        User::logout();
                        header('Location: ../../../public/login.php');
                    } 
    
                } else if($user->getRole() == 'etudiant'){
                    $_SESSION['message'] = "Welcome back ".$user->getNom();
                    $_SESSION['message_type'] = "success";
                    header('Location: ../../../public/index.php'); 
                } else if($user->getRole() == 'admin'){
                    $_SESSION['message'] = "Welcome back ".$user->getNom();
                    $_SESSION['message_type'] = "success";
                    header('Location: ../../../public/admin/index.php'); 
                }
            }
             
            } else {
                $_SESSION['message'] = "User Not Found";
                $_SESSION['message_type'] = "error";
                header('Location: ../../../public/login.php');
            }
            exit;
            
            

    } else if (isset($_POST['fullName-signup'])) {
        $email = trim(htmlspecialchars($_POST['email-signup']));
        $password = trim(htmlspecialchars($_POST['password-signup']));
        $fullName = trim(htmlspecialchars($_POST['fullName-signup']));
        $role = trim(htmlspecialchars($_POST['role-signup']));

        if ($role === 'etudiant') {
            $res = Etudiant::signup($fullName, $email, $password, $role);
        } else if ($role === 'enseignant') {
            $res = Enseignant::signup($fullName, $email, $password, $role, 0);
        } else {
            $_SESSION['message'] = "Invalid role selected";
            $_SESSION['message_type'] = "error";
            header('Location: ../../../public/login.php');
            exit;
        }

        if ($res) {
            $_SESSION['message_type'] = "success";
            $_SESSION['message'] = "Signup successful! Please log in.";
            header('Location: ../../../public/login.php');
        } else {
            $_SESSION['message_type'] = "error";
            $_SESSION['message'] = "Email already exists";
            header('Location: ../../../public/login.php');
        }
        exit;

    } else {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }
} else if ($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['logout']))
{   
    User::logout();
    header('Location: ../../../public/login.php');
}else {
    echo "Invalid request method";
}
?>
