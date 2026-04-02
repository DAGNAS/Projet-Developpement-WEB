<?php

namespace App\Models;

use App\Core\SQLDatabase;

class SearchModel extends Model {

    public function __construct($database = null) {
        if (is_null($database)) {
            $this->database = new SQLDatabase();
        } else {
            $this->database = $database;
        }
    }

    public function ListAllCompany() {
        return $this->database->getAllCompany();
    }

    public function PersonalQuery($query, $location, $sector, $type, $limit, $offset) {
        $querys = $this->database->setQuery($query, $location, $sector, $type);
        return [
            'query' => array_slice($querys, $offset, $limit),
            'count' => count($querys)
        ];
    }

    public function getAllStudents() {
    return $this->database->getAllStudents();
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