<?php

namespace App\Core;

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

    public function setQuery($query, $location, $sector, $type) {
        $sql = "SELECT id_offre AS id, titre, description, type_contrat AS type 
FROM job_offers 
WHERE 1=1";
        $params = [];

        if (!empty($query)) {
            $sql .= " AND title LIKE :query";
            $params['query'] = "%" . $query . "%";
        }

        if (!empty($location)) {
            $sql .= " AND location LIKE :location";
            $params['location'] = "%" . $location . "%";
        }

        if (!empty($sector)) {
            $sql .= " AND sector LIKE :sector";
            $params['sector'] = "%" . $sector . "%";
        }

        if (!empty($type)) {
            $sql .= " AND type LIKE :type";
            $params['type'] = "%" . $type . "%";
        }

        $stmt = $this->database->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function GetOfferById($id) {
        $stmt = $this->database->prepare("SELECT * FROM job_offers JOIN company ON job_offers.id_company = company.id WHERE job_offers.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
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
            'email'         => $email
        ]);
    }

    public function toggleEmailNotifications($email) {
        $stmt = $this->database->prepare("UPDATE users SET email_notif = NOT email_notif WHERE email = :email");
        $stmt->execute([
            'email'         => $email
        ]);
    }

    public function GetAllApplicationByMail($email) {
        $tmp_data = $this->getUserInfoByMail($email);

        $stmt = $this->database->prepare("  SELECT  a.status, 
                                                    a.apply_date, 
                                                    jo.title AS job_title, 
                                                    c.nom AS company_name,
                                                    c.logo AS company_logo
                                            FROM applications a
                                            JOIN job_offers jo ON a.id_job_offer = jo.id
                                            JOIN company c ON jo.id_company = c.id
                                            WHERE a.id_student = :id_student;");
        $stmt->execute([
            'id_student'    => $tmp_data['id']
        ]);
        return $stmt->fetchAll();
    }
    public function getAllStudents() {
    $stmt = $this->database->query("SELECT * FROM users WHERE role = 'student'");
    return $stmt->fetchAll();
    }
    public function getPDO() {
    return $this->database;
}
}