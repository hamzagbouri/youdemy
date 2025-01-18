<?php

require_once __DIR__ . '/../../classes/User.php';
require_once __DIR__ . '/../../classes/enseignant.php';
require_once __DIR__ . '/../../classes/etudiant.php';
require_once __DIR__ . '/../../classes/admin.php';
print_r($_POST);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['user_id'];
    if(isset($_POST['ban']))
    {
        $value = $_POST['ban'];
       
        if($value == 'ban')
        {
            $ban = 1;
        }else {
            $ban = 0;
        }
       $res = User::setBan($id,$ban);
       var_dump($res);
    } else if(isset($_POST['active']))
    {

        $value = $_POST['active'];
       
        if($value == 'activate')
        {
            $active = 1;
        }else {
            $active = 0;
        }
        Enseignant::setActive($id,$active);
    } else {
        print_r($_POST);
    }
    header('Location: ../../../public/admin/user.php');
} else {
    echo "aa";
}

?>