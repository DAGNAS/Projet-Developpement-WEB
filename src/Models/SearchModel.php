<?php

namespace App\Models;

class SearchModel extends Model {

    public function __construct($database = null) {
        if (is_null($database)) {
            $this->database = new \App\Core\SQLDatabase();
        } else {
            $this->database = $database;
        }
    }

    public function ListAllCompany() {
        return $this->database->getAllCompany();
    }
}