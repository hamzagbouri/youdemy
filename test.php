<?php
require_once './app/classes/User.php';
require_once './app/classes/enseignant.php';
require_once './app/classes/etudiant.php';
require_once './app/classes/coursTexte.php';

// $res1 = Enseignant::signup('Hamza Enseignant','hamzagbouri2004@enseignant.com','mamababa','enseignant',0);
// $res = Etudiant::signup('Admin Admin','admin@admin.admin','admin','admin');
// echo $res1;
// echo $res;
// $res = User::login('hamzagbouri2004@enseignant.com','mamababa');
// if($res)
// {
//     echo $_SESSION['user'];
// }

$coursTexte = new coursTexte(null,"Cours Text","Descipriotn 1 ", 1,"test","text contenue","image_path");
$res = $coursTexte->ajouter();

echo $res;



?>