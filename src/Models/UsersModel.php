<?php


namespace App\Models;

class UsersModel extends Model {

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
}

?>