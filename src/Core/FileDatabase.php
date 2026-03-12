<?php

namespace App\Models;

/**
 * Class FileDatabase
 * Implements the Database interface and provides functionality to interact with a CSV file-based database.
 */
class FileDatabase implements Database {

    /**
     * @var string The path to the database file.
     */
    private $path;

    public function __construct($path) {
        $host = '127.0.0.1';      // ou 'localhost'
        $dbname = 'prosit_php';     // nom de ta base
        $user = 'root';           // utilisateur MySQL
        $pass = '';               // mot de passe root, vide par défaut
        $port = 3307;
    
        try {
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
            // Activer les exceptions en cas d'erreur
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    
}