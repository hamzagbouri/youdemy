<?php
require_once __DIR__.'/../../classes/enseignant.php';
require_once __DIR__.'/../../classes/User.php';
require_once __DIR__.'/../../classes/etudiant.php';


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
            if($user->getRole() == 'enseignant')
            {
                $res = Enseignant::isActive($user->getId());
                if($res->getActive())
                {
                   $_SESSION['message'] = "Welcome back ".$user->getNom();
                    $_SESSION['message_type'] = "success";
                    header('Location: ../../../public/index.php'); 
                } else {
                   
                    $_SESSION['message'] = "Votre Compte pas encore active";
                    $_SESSION['message_type'] = "error";
                    User::logout();
                }

            } else {
                $_SESSION['message'] = "Welcome back ".$user->getNom();
                $_SESSION['message_type'] = "success";
                header('Location: ../../../public/index.php'); 
            }
         
        } else {
            $_SESSION['message'] = "Error Logging In";
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
