<?php


namespace App\Models;

use App\Core\SQLDatabase;


class UsersModel extends Model {

    public function __construct($database = null) {
        if(is_null($database)) {
            $this->database = new SQLDatabase();
        } else {
            $this->database = $database;
        }
    }

    public function getNavLinks($role) {
        $links = [
        'admin' => [
            ['nom' => 'Recherche', 'lien' => '?uri=search'],
            ['nom' => 'Stats Système', 'lien' => '?uri=system'],
            ['nom' => 'Mon Compte', 'lien' => '?uri=profile'],
            ['nom' => 'Changer de profile', 'lien' => '?uri=change-account'],
            ['nom' => 'Créer un profile', 'lien' => '?uri=create-account']
        ],
        'company' => [
            ['nom' => 'Recherche', 'lien' => '?uri=search'],
            ['nom' => 'Mes Offres', 'lien' => '?uri=my-posts'],
            ['nom' => 'Mon Compte', 'lien' => '?uri=profile']
        ],
        'pilote' => [
            ['nom' => 'Recherche', 'lien' => '?uri=search'],
            ['nom' => 'Mes Étudiants', 'lien' => '?uri=my-students'],
            ['nom' => 'Mon Compte', 'lien' => '?uri=profile']
        ],
        'student' => [
            ['nom' => 'Recherche', 'lien' => '?uri=search'],
            ['nom' => 'Mes Candidatures', 'lien' => '?uri=applications'],
            ['nom' => 'Ma Wishlist', 'lien' => '?uri=wishlist'],
            ['nom' => 'Mon Compte', 'lien' => '?uri=profile']
        ]
        ];
        return $links[$role];
    }

    public function getUserInfo($userEmail) {
        return $this->database->getUserInfoByMail($userEmail);
    }

    public function updatePassword($data){
        // Hachage du mot de passe pour la sécurité
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->database->updatePassword($data['email'], $hashedPassword);
    }

    public function SaveTimeLastConnexion($email) {
        $this->database->SaveTimeLastConnexion($email);
    }

    public function toggleEmailNotifications($email){
        $this->database->toggleEmailNotifications($email);
    }

    public function getCompanyByUserEmail($email) {
        return $this->database->getCompanyByUserEmail($email);
    }

    public function getOffersPaginatedByCompany($id_company, $limit, $offset) {
        return $this->database->getOffersPaginatedByCompany($id_company, $limit, $offset);
    }

    public function countOffersByCompany($id_company) {
        return $this->database->countOffersByCompany($id_company);
    }

    public function getOfferByIdAndCompany($id_offer, $id_company) {
        return $this->database->getOfferByIdAndCompany($id_offer, $id_company);
    }

    public function getApplicationsByOffer($id_offer) {
        return $this->database->getApplicationsByOffer($id_offer);
    }

    public function deleteOffer($id) {
        $this->database->deleteOffer($id);
    }

    public function updateOffer($id,$title,$sector,$type,$description,$location){
        $this->database->updateOffer($id,$title,$sector,$type,$description,$location);
    }

    public function createOffer($id_company, $title, $sector, $type, $description, $location) {
        $this->database->createOffer($id_company, $title, $sector, $type, $description, $location);
    }

    public function deleteOfferByCompany($id_offer, $id_company) {
        $this->database->deleteOfferByCompany($id_offer, $id_company);
    }
}

?>
