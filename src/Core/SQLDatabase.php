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
    
        try {
            $this->database = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
            
            // Activer les exceptions et le mode de retour en tableau associatif par défaut
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    /**
     * Exemple de méthode pour récupérer la connexion dans tes Models
     */
    public function getAllCompany()
    {
        $stmt = $this->database->prepare("SELECT * FROM company");
        $stmt->execute();
        $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $liste;
    }

    // ATTENTION : Tu dois obligatoirement implémenter ICI toutes les fonctions 
    // qui sont listées dans ton fichier Database.php (ex: find, save, delete...)
    // Sinon tu auras une erreur "Class contains abstract methods"
}