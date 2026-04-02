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

            $this->database = new PDO(

                "mysql:

                    host=" . $env['host'] . ";

                    port=" . $env['port'] . ";

                    dbname=" . $env['dbname'] . ";

                    charset=utf8mb4",

                $env["user"],

                $env["pass"]

            );

            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            die("Erreur de connexion : " . $e->getMessage());

        }

    }

    public function prepare($sql) {

        return $this->database->prepare($sql);

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

    public function getOfferById($id) {

        $stmt = $this->database->prepare("

            SELECT job_offers.*, company.nom AS company_name

            FROM job_offers

            LEFT JOIN company ON company.id = job_offers.id_company

            WHERE job_offers.id = :id

        ");

        $stmt->execute([

            'id' => $id

        ]);

        return $stmt->fetch();

    }

    public function updateOffer($id, $title, $sector, $type, $description, $location) {

        $stmt = $this->database->prepare("

            UPDATE job_offers

            SET title = :title,

                sector = :sector,

                type = :type,

                description = :description,

                location = :location

            WHERE id = :id

        ");

        $stmt->execute([

            'id' => $id,

            'title' => $title,

            'sector' => $sector,

            'type' => $type,

            'description' => $description,

            'location' => $location

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

    public function getOffersPaginated($limit, $offset) {

        $stmt = $this->database->prepare("

            SELECT job_offers.*, company.nom AS company_name

            FROM job_offers

            LEFT JOIN company ON company.id = job_offers.id_company

            ORDER BY created_at DESC

            LIMIT :limit OFFSET :offset

        ");

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

    }

    public function countOffers() {

        $stmt = $this->database->query("SELECT COUNT(*) as total FROM job_offers");

        return $stmt->fetch();

    }

    public function getCompanyIdByUserEmail($email) {

        $stmt = $this->database->prepare("SELECT id FROM company WHERE email = :email LIMIT 1");

        $stmt->execute([

            'email' => $email

        ]);

        return $stmt->fetch();

    }

    public function getFirstCompany() {

        $stmt = $this->database->query("SELECT id FROM company LIMIT 1");

        return $stmt->fetch();

    }

    public function getUserInfoByMail($userEmail) {

        $stmt = $this->database->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->execute([

            'email' => $userEmail

        ]);

        return $stmt->fetch();

    }

    public function updatePassword($email, $hash) {

        $stmt = $this->database->prepare("UPDATE users SET password = :pass WHERE email = :email");

        $stmt->execute([

            'pass' => $hash,

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

    public function GetAllApplicationByMail($email) {

        $tmp_data = $this->getUserInfoByMail($email);

        $stmt = $this->database->prepare("

            SELECT  a.status,

                    a.apply_date,

                    jo.title AS job_title,

                    c.nom AS company_name,

                    c.logo AS company_logo

            FROM applications a

            JOIN job_offers jo ON a.id_job_offer = jo.id

            JOIN company c ON jo.id_company = c.id

            WHERE a.id_student = :id_student

        ");

        $stmt->execute([

            'id_student' => $tmp_data['id']

        ]);

        return $stmt->fetchAll();

    }

    public function getAllStudents() {
    $stmt = $this->database->query("SELECT * FROM users WHERE role = 'student'");
    return $stmt->fetchAll();
    }



    public function deleteOffer($id) {
   $stmt = $this->database->prepare("DELETE FROM job_offers WHERE id = :id");
   $stmt->execute([
       'id' => $id
   ]);
}

public function getUserByEmail($email) {
   $stmt = $this->database->prepare("SELECT * FROM users WHERE email = :email");
   $stmt->execute([
       'email' => $email
   ]);
   return $stmt->fetch();
}
public function getCompanyByUserEmail($email) {
   $user = $this->getUserByEmail($email);
   if (!$user) {
       return false;
   }
   $stmt = $this->database->prepare("
       SELECT * FROM company
       WHERE id_contact = :id_contact
       LIMIT 1
   ");
   $stmt->execute([
       'id_contact' => $user['id']
   ]);
   return $stmt->fetch();
}
public function getOffersPaginatedByCompany($companyId, $limit, $offset) {
   $stmt = $this->database->prepare("
       SELECT job_offers.*, company.nom AS company_name
       FROM job_offers
       LEFT JOIN company ON company.id = job_offers.id_company
       WHERE job_offers.id_company = :company_id
       ORDER BY created_at DESC
       LIMIT :limit OFFSET :offset
   ");
   $stmt->bindValue(':company_id', (int)$companyId, PDO::PARAM_INT);
   $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
   $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
   $stmt->execute();
   return $stmt->fetchAll();
}
public function countOffersByCompany($companyId) {
   $stmt = $this->database->prepare("
       SELECT COUNT(*) as total
       FROM job_offers
       WHERE id_company = :company_id
   ");
   $stmt->execute([
       'company_id' => $companyId
   ]);
   return $stmt->fetch();
}
public function getOfferByIdAndCompany($offerId, $companyId) {
   $stmt = $this->database->prepare("
       SELECT job_offers.*, company.nom AS company_name
       FROM job_offers
       LEFT JOIN company ON company.id = job_offers.id_company
       WHERE job_offers.id = :offer_id
         AND job_offers.id_company = :company_id
       LIMIT 1
   ");
   $stmt->execute([
       'offer_id' => $offerId,
       'company_id' => $companyId
   ]);
   return $stmt->fetch();
}
public function deleteOfferByCompany($offerId, $companyId) {
   $stmt = $this->database->prepare("
       DELETE FROM job_offers
       WHERE id = :offer_id
         AND id_company = :company_id
   ");
   $stmt->execute([
       'offer_id' => $offerId,
       'company_id' => $companyId
   ]);
}

}
 

