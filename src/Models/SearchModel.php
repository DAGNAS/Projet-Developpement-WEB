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

    public function ListAllJobApplication(){
        return $this->database->getAllJobApplication();
    }
    
    public function getCompaniesPaginated($limit, $offset) {
        $companies = $this->ListAllCompany();
        return array_slice($companies, $offset, $limit);
    }

    public function getAllJobApplicationPaginated($limit, $offset) {
        $jobApplication = $this->ListAllJobApplication();
        return array_slice($jobApplication, $offset, $limit);
    }

    public function countCompanies() {
        $companies = $this->database->getAllCompany();
        return count($companies);
    }

    public function countJobApplication() {
        $jobApplication = $this->ListAllJobApplication();
        return count($jobApplication);
    }
}

?>
