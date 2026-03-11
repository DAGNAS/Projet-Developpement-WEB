<?php
namespace App\Models;

class SecurityModel extends Model {

    public function __construct($connection = null) {

        /*
        if(is_null($connection)) {
            $this->connection = new FileDatabase();
        } else {
            $this->connection = $connection;
        }
            */
    }

    public function authenticate($login, $password) {
        // TODO : implement authentication logic
        return true;
    }
}

?>