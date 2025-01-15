<?php

require_once __DIR__ . '/../../classes/Cours.php';

class getCours{
    static function getAll()
    {
        return Cours::afficherTous();
    }
}