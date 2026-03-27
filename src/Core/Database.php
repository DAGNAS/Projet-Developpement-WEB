<?php
namespace App\Core;
/**
 * This interface represents a database.
 */
interface Database {
    
    public function getAllCompany();

    public function getUserInfoByMail($userEmail);
    
}

?>