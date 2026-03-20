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
        
        $env = parse_ini_file(".env");
    
        try {
            $this->database = new PDO("mysql:
                        host=".$env["host"].";
                        port=".$env['port'].";
                        dbname=".$env['dbname'].";
                        charset=utf8mb4", 
                        
                        $env["user"], $env["pass"]);
            
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
        $stmt = $this->database->query("SELECT * FROM entreprise");
        $liste = $stmt->fetchAll();
        return $liste;
    }

    public function getUserInfoByMail($userEmail){
        $stmt = $this->database->prepare("SELECT * FROM test_users WHERE email = :email");
        $stmt->execute(['email' => $userEmail]);
        return $stmt->fetch();
    }

    public function updateUserInfo($data) {

        $stmt = $this->database->prepare("UPDATE test_users SET nom = :nom, prenom = :prenom, ville = :ville WHERE email = :email");
        $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'ville' => $data['ville'],
            'email' => $data['mail']
        ]);
    }

    // ATTENTION : Tu dois obligatoirement implémenter ICI toutes les fonctions 
    // qui sont listées dans ton fichier Database.php (ex: find, save, delete...)
    // Sinon tu auras une erreur "Class contains abstract methods"
}