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
        return $this->database->getOffersPaginated($limit, $offset);
    }
   
    public function countOffers() {
     $stmt = $this->database->query("SELECT COUNT(*) as total FROM job_offers");
    return $stmt->fetch();
}
}