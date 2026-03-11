<?php


namespace App\Models;

class UsersModel extends Model {

    public function getNavLinks($role) {
        $links = [
        'admin' => [
            ['nom' => 'Gérer Utilisateurs', 'lien' => '?uri=admin/users'],
            ['nom' => 'Stats Système', 'lien' => '?uri=admin/stats']
        ],
        'company' => [
            ['nom' => 'Recherche', 'lien' => '?uri=search'],
            ['nom' => 'Mes Offres', 'lien' => '?uri=company/offers'],
            ['nom' => 'Mon Compte', 'lien' => '?uri=company/profile']
        ],
        'pilote' => [
            ['nom' => 'Recherche', 'lien' => '?uri=search'],
            ['nom' => 'Mes Étudiants', 'lien' => '?uri/pilote/students'],
            ['nom' => 'Mon Compte', 'lien' => '?uri=pilote/profile']
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






/*
namespace App\Models;

class UsersModels extends Model {

    /**
     * UsersModels constructor.
     * 
     * @param mixed $connection The database connection. If null, a new FileDatabase connection will be created.
     *//*
    public function __construct($connection = null) {
        if(is_null($connection)) {
            $this->connection = new FileDatabase('tasks', ['task', 'status']);
        } else {
            $this->connection = $connection;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user = $_GET["user"];


    if ($user == "admin") {
        $liste_page = ["mode_changement.php?user=admin", "info-systeme.php?user=admin", "recherche.php?user=admin"];
        $liste_nom_page = ["Mode de changement", "Info système", "Recherche d'entreprise"];
    }

    if ($user == "entreprise") {
        $liste_page = ["mes-offres.php?user=entreprise", "recherche.php?user=entreprise", "mon-compte.php?user=entreprise"];
        $liste_nom_page = ["Mes Offres", "Recherche d'entreprise", "Mon Compte"];
    }

    if ($user == "pilote") {
        $liste_page = ["mes-etudiants.php?user=pilote", "recherche.php?user=pilote", "mon-compte.php?user=pilote"];
        $liste_nom_page = ["Mes Étudiants", "Recherche d'entreprise", "Mon Compte"];
    }

    if ($user == "etudiant") {
        $liste_page = ["mes-candidatures.php?user=etudiant", "recherche.php?user=etudiant", "ma-wishlist.php?user=etudiant", "mon-compte.php?user=etudiant"];
        $liste_nom_page = ["Mes Candidatures", "Recherche d'entreprise", "Ma Wishlist", "Mon Compte"];
    }
}
*/



/*
<?php

$nom_valide = "Marc";
$pilote_valide = "Marc";
$mail_valide = "votre@email.com";
$password1_valide = "1234";
$password2_valide = "1234";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_GET["user"];

    $list_champs = [];
    $list_verification = [];

    if ($user == "admin") {
        $list_champs = [$_POST["nom"], $_POST["password1"], $_POST["password2"]];
        $list_verification = [$nom_valide, $password1_valide, $password2_valide];

    }
    if ($user == "entreprise") {
        $list_champs = [$_POST["nom"], $_POST["mail"], $_POST["password1"]];
        $list_verification = [$nom_valide, $mail_valide, $password1_valide];
    }
    if ($user == "pilote") {
        $list_champs = [$_POST["nom"], $_POST["mail"], $_POST["password1"]];
        $list_verification = [$nom_valide, $mail_valide, $password1_valide];
    }
    if ($user == "etudiant") {
        $list_champs = [$_POST["nom"], $_POST["pilote"], $_POST["password1"]];
        $list_verification = [$nom_valide, $pilote_valide, $password1_valide];
    }

    if (isset($user)) {
        if ($list_champs === $list_verification) {
            header("Location: recherche.php?user=" . $user);
            exit(); 
        } else {
            header("Location: connexion.php?user=" . $user . "&error=1");
            exit();
        }
    }
}
?>
*/

?>