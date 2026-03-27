<?php
namespace App\Models;

use App\Core\SQLDatabase;

class SearchModel extends Model {

    public function __construct($database = null) {
        if(is_null($database)) {
            $this->database = new SQLDatabase();
        } else {
            $this->database = $database;
        }
    }

    public function ListAllCompany(){
        return $this->database->getAllCompany();
    }
    
    public function getCompaniesPaginated($limit, $offset) {
        $companies = $this->database->getAllCompany();
        return array_slice($companies, $offset, $limit);
    }

    public function countCompanies() {
        $companies = $this->database->getAllCompany();
        return count($companies);
    }
}