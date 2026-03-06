<?php

$liste_page = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user = $_GET["user"];


    if ($user == "admin") {
        $liste_page = ["mode_changement.php?user=admin", "info_system.php", "recherche.php?user=admin"];
        $liste_nom_page = ["Mode de changement", "Info système", "Recherche d'entreprise"];
    }

    if ($user == "entreprise") {
        $liste_page = ["mes-offres.php", "recherche.php?user=entreprise", "mon-compte.php?user=entreprise"];
        $liste_nom_page = ["Mes Offres", "Recherche d'entreprise", "Mon Compte"];
    }

    if ($user == "pilote") {
        $liste_page = ["mes-etudiants.php", "recherche.php?user=pilote", "mon-compte.php?user=pilote"];
        $liste_nom_page = ["Mes Étudiants", "Recherche d'entreprise", "Mon Compte"];
    }

    if ($user == "etudiant") {
        $liste_page = ["mes-candidatures.php", "recherche.php?user=etudiant", "ma-wishlist.php", "mon-compte.php?user=etudiant"];
        $liste_nom_page = ["Mes Candidatures", "Recherche d'entreprise", "Ma Wishlist", "Mon Compte"];
    }
}


?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Recherche d'Entreprise - Job's Horizon</title>
        <link rel="stylesheet" href="assets/style/global/base.css">
        <link rel="stylesheet" href="assets/style/global/layout.css">
        <link rel="stylesheet" href="assets/style/global/components.css">
        <link rel="stylesheet" href="assets/style/pages/recherche.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header>
            <img class="logo-image" src="assets/images/menu/header/Logo-header.png" alt="Logo">
            <img class="header-icone" src="assets/images/menu/header/header-icone-1.png" alt="icone 1">
            <img class="header-icone" src="assets/images/menu/header/header-icone-2.png" alt="icone 2">
            <img class="header-icone" src="assets/images/menu/header/header-icone-3.png" alt="icone 3">


            <input type="checkbox" id="side-menu-check" style="display: none;">
            <label for="side-menu-check" class="header-btn">
                <a >Mes Infos</a>
            </label>

            <nav class="sidebar">
                <label for="side-menu-check" class="close-btn">×</label>
                <div class="sidebar-links">
                    <?php 
                        $nb_pages = count($liste_page);

                        for ($i = 0; $i < $nb_pages; $i++) {
                            echo '<a href="' . $liste_page[$i] . '">' . $liste_nom_page[$i] . '</a>';
                        }
                    ?>
                    <hr style="border: 1px solid #0075a2; margin: 20px 0;">
                    <a href="homepage.html" style="color: orange; font-weight: bold;">Déconnexion</a>
                </div>
            </nav>
        </header>

        <section class="search-section">
            <h1>Trouvez votre future entreprise</h1>
            <div class="search-bar">
                <input type="text" placeholder="Nom de l'entreprise, secteur...">
                <input type="text" placeholder="Localisation (ex: La Rochelle)">
                <button class="search-btn">Rechercher</button>
            </div>
        </section>

        <section class="results-container">
            <div class="company-grid">
                <div class="company-card">
                    <div class="company-logo">
                        <img src="assets/images/menu/body/enterprise-icone.png" alt="Logo Entreprise">
                    </div>
                    <div class="company-info">
                        <h3>Nom de l'Entreprise</h3>
                        <p class="sector">Secteur : Informatique</p>
                        <p class="location">📍 La Rochelle</p>
                        <a href="#" class="view-btn">Voir les offres</a>
                    </div>
                </div>

                <div class="company-card">
                    <div class="company-logo">
                        <img src="assets/images/menu/body/enterprise-icone.png" alt="Logo Entreprise">
                    </div>
                    <div class="company-info">
                        <h3>Tech Solutions</h3>
                        <p class="sector">Secteur : Développement Web</p>
                        <p class="location">📍 Lagord</p>
                        <a href="#" class="view-btn">Voir les offres</a>
                    </div>
                </div>

                <div class="company-card">
                    <div class="company-logo">
                        <img src="assets/images/menu/body/enterprise-icone.png" alt="Logo Entreprise">
                    </div>
                    <div class="company-info">
                        <h3>Build It</h3>
                        <p class="sector">Secteur : BTP / Génie Civil</p>
                        <p class="location">📍 Aytré</p>
                        <a href="#" class="view-btn">Voir les offres</a>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <p>© 2026 - All rights reserved.</p>

            <div class="footer">
                <div class="bloc">
                    <h3>Partenaires</h3>
                    <ul class="partenaires">
                        <li><a href="#">CESI, La Rochelle</a></li>
                    </ul>
                </div>

                <div class="bloc">
                    <h3>Contacts</h3>
                    <a href="#" class="res">
                        <img src="assets/images/menu/footer/A.png" alt="Logo">
                        8 Rue Isabelle Autissier, Lagord
                    </a>
                    <a href="#" class="res">
                        <img src="assets/images/menu/footer/S.png" alt="Logo">
                        05 00 00 00 00
                    </a>
                    <a href="#" class="res">
                        <img src="assets/images/menu/footer/E.png" alt="Logo">
                        paul.jack@gmail.com
                    </a>
                    </a>
                    <a href="#" class="res">
                        <p>‍👨‍💼 Kaëlig CLENET</p>
                    </a>
                </div>

                <div class="bloc">
                    <h3>Réseaux</h3>
                    <ul class="reseaux">
                        <li>
                            <a href="#" class="res">
                                <img src="assets/images/menu/footer/I.png" alt="Logo">
                                Instagram
                            </a>
                            <a href="#" class="res">
                                <img src="assets/images/menu/footer/X.png" alt="Logo">
                                Twitter
                            </a>
                            <a href="#" class="res">
                                <img src="assets/images/menu/footer/T.png" alt="Logo">
                                TikTok
                            </a>
                            <a href="#" class="res">
                                <img src="assets/images/menu/footer/Y.png" alt="Logo">
                                Youtube
                            </a>
                            <a href="#" class="res">
                                <img src="assets/images/menu/footer/L.png" alt="Logo">
                                CESI, La Rochelle
                            </a>
                            <a href="#" class="res">
                                <img src="assets/images/menu/footer/F.png" alt="Logo">
                                Facebook
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="bloc">
                    <h3>Mentions légales</h3>
                    <ul class="mentions">
                        <li><a href="mention-legale.html">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>