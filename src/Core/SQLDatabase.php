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
        
        $env = parse_ini_file(__DIR__ . "/../../.env", false, INI_SCANNER_RAW);
    
        try {
            $this->database = new PDO("mysql:
                        host=".$env['host'].";
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
        $stmt = $this->database->query("SELECT * FROM company");
        $liste = $stmt->fetchAll();
        return $liste;
    }

public function getUserInfoByMail($userEmail){
    $stmt = $this->database->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $userEmail]);
    return $stmt->fetch();
}

public function updatePassword($email, $hash) {
    $stmt = $this->database->prepare("UPDATE users SET password = :pass WHERE email = :email");
    $stmt->execute([
        'pass'  => $hash,
        'email' => $email
    ]);
}

public function SaveTimeLastConnexion($email) {
    $stmt = $this->database->prepare("UPDATE users SET date_login = NOW() WHERE email = :email");
    $stmt->execute([
        'email' => $email
    ]);
}

public function toggleEmailNotifications($email) {
    $stmt = $this->database->prepare("UPDATE users SET email_notif = NOT email_notif WHERE email = :email");
    $stmt->execute([
        'email' => $email
    ]);
}
}