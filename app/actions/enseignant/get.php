<?php

require_once __DIR__ . '/../../classes/enseignant.php';
class getEnseignant{
    static function totalInscription($id)
    {
        return Enseignant::totalInscription($id);
    }
    static function totalCours($id)
    {
        return Enseignant::totalCours($id);
    }

}

?>