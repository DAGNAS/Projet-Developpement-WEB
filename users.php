<?php

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

?>