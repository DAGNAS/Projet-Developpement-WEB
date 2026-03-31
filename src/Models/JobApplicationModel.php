<?php


namespace App\Models;

use App\Core\SQLDatabase;

class JobApplicationModel extends Model {

    public function __construct($database = null) {
        if(is_null($database)) {
            $this->database = new SQLDatabase();
        } else {
            $this->database = $database;
        }
    }

    public function GetAllApplicationByMail($email){
        return $this->database->GetAllApplicationByMail($email);
    }


}