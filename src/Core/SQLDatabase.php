<?php

namespace App\Core;

// 1. IMPORT des classes natives PHP (indispensable quand on a un namespace)
use PDO;
use PDOException;

class SQLDatabase implements Database {
    public function getCompanyIdByUserEmail($email) {
    $stmt = $this->database->prepare("SELECT id FROM company WHERE email = :email LIMIT 1");
    $stmt->execute([
        'email' => $email
    ]);
    return $stmt->fetch();
}

public function createOffer($idCompany, $title, $sector, $type, $description, $location) {
    $stmt = $this->database->prepare("
        INSERT INTO job_offers (id_company, title, sector, type, description, location)
        VALUES (:id_company, :title, :sector, :type, :description, :location)
    ");

    $stmt->execute([
        'id_company' => $idCompany,
        'title' => $title,
        'sector' => $sector,
        'type' => $type,
        'description' => $description,
        'location' => $location
    ]);
}

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

public function getFirstCompany() {
    $stmt = $this->database->query("SELECT id FROM company LIMIT 1");
    return $stmt->fetch();
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
public function getAllOffers() {
    $stmt = $this->database->query("
        SELECT job_offers.*, company.nom AS company_name
        FROM job_offers
        LEFT JOIN company ON company.id = job_offers.id_company
        ORDER BY created_at DESC
    ");
    return $stmt->fetchAll();
}

public function prepare($sql) {
    return $this->database->prepare($sql);
}

public function getOffersPaginated($limit, $offset) {
    $stmt = $this->database->prepare("
        SELECT job_offers.*, company.nom AS company_name
        FROM job_offers
        LEFT JOIN company ON company.id = job_offers.id_company
        ORDER BY created_at DESC
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

public function countOffers() {
    $stmt = $this->database->query("SELECT COUNT(*) as total FROM job_offers");
    return $stmt->fetch();
}

}