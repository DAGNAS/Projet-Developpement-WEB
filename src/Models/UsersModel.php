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
            ['nom' => 'Stats Système', 'lien' => '?uri=system']
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
}

?>