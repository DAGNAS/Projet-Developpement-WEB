<?php

namespace App\Core;

// 1. IMPORT des classes natives PHP (indispensable quand on a un namespace)
use PDO;
use PDOException;

class SQLDatabase implements Database {

    /**
     * @var PDO La connexion à la base de données
     */
    private $database;

    public function __construct() {
        // Paramètres de connexion
        $host = '127.0.0.1';
        $dbname = 'jobshorizonbdd';
        $user = 'root';
        $pass = '';
        $port = 3307;

    }

    /**
     * Exemple de méthode pour récupérer la connexion dans tes Models
     */
    public function getAllCompany()
    {
        $liste = 0;
        return $liste;
    }

    // ATTENTION : Tu dois obligatoirement implémenter ICI toutes les fonctions 
    // qui sont listées dans ton fichier Database.php (ex: find, save, delete...)
    // Sinon tu auras une erreur "Class contains abstract methods"
}