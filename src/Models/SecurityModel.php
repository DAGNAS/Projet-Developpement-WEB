<?php

namespace App\Models;

use App\Core\SQLDatabase;

class SecurityModel extends Model {

    public function __construct($database = null) {
        if(is_null($database)) {
            $this->database = new SQLDatabase();
        } else {
            $this->database = $database;
        }
    }

    public function authenticate($login, $email, $password) {
        $code = $this->database->getUserInfoByMail($email);

        if (!$code) {
            return false;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        
        $passwordIsValid = password_verify($password, $code['password']) || $password === $code['password'];

        if ($passwordIsValid && $login === $code['prenom'] && $_SESSION['user_role'] === $code['role']) {
            
            $_SESSION['user_email'] = $code['email'];
            $_SESSION['user_prenom'] = $code['prenom'];
            $_SESSION['user_role'] = $code['role'];
            
            $_SESSION['user_id'] = $email;

            return true;
        } 

        return false;
    }
}

?>
