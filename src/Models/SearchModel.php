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
    public function getWishlistIds($profileId) {
    $db = $this->database->getPDO();

$stmt = $db->prepare("
    SELECT id_offre FROM Wish_list WHERE id_profile = :id
");
$stmt->execute(['id' => $profileId]);

return array_column($stmt->fetchAll(), 'id_offre');
    $stmt->execute(['id' => $profileId]);
    return array_column($stmt->fetchAll(), 'id_offre');
}
 
public function toggleWishlist($profileId, $offreId) {

    $db = $this->database->getPDO();

    $stmt = $db->prepare("
        SELECT * FROM Wish_list 
        WHERE id_profile = :profile AND id_offre = :offre
    ");
    $stmt->execute([
        'profile' => $profileId,
        'offre' => $offreId
    ]);

    if ($stmt->fetch()) {
        
        $stmt = $db->prepare("
            DELETE FROM Wish_list 
            WHERE id_profile = :profile AND id_offre = :offre
        ");
        $stmt->execute([
            'profile' => $profileId,
            'offre' => $offreId
        ]);
    } else {
       
        $stmt = $db->prepare("
            INSERT INTO Wish_list (id_profile, id_offre)
            VALUES (:profile, :offre)
        ");
        $stmt->execute([
            'profile' => $profileId,
            'offre' => $offreId
        ]);
    }
}
public function getWishlistOffers($profileId) {

    $db = $this->database->getPDO();

    $stmt = $db->prepare("
        SELECT job_offers.*
        FROM Wish_list
        JOIN job_offers ON Wish_list.id_offre = job_offers.id_offre
        WHERE id_profile = :id
    ");
    $stmt->execute(['id' => $profileId]);

    return $stmt->fetchAll();
}
public function getStudentById($id) {

    $db = $this->database->getPDO();

    $stmt = $db->prepare("
        SELECT prenom, nom FROM users WHERE id = :id
    ");
    $stmt->execute(['id' => $id]);

    return $stmt->fetch();
}
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