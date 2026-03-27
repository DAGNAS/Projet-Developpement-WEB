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
    $db = Database::getConnection();

    $stmt = $db->prepare("SELECT * FROM company LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll();
}
}

?>