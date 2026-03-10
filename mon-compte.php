<?php

include "users.php";

?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Mon Compte - Job's Horizon</title>
        <link rel="stylesheet" href="assets/style/global/base.css">
        <link rel="stylesheet" href="assets/style/global/layout.css">
        <link rel="stylesheet" href="assets/style/global/components.css">
        <link rel="stylesheet" href="assets/style/pages/mon-compte.css">
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

        <main class="account-container">
            <section class="profile-header">
                <h1>Mon Profil</h1>
                <p>Bienvenue dans votre espace personnel, gérez vos informations et vos préférences.</p>
            </section>

            <div class="profile-grid">
                <div class="profile-card">
                    <div class="card-header">
                        <img src="assets/images/menu/body/student-icone.png" alt="Icone Profil">
                        <h2>Informations Personnelles</h2>
                    </div>
                    <div class="card-content">
                        <div class="info-group">
                            <label>Nom complet</label>
                            <p>Marc Dupont</p> </div>
                        <div class="info-group">
                            <label>Adresse Mail</label>
                            <p>votre@email.com</p>
                        </div>
                        <div class="info-group">
                            <label>Rôle</label>
                            <span class="badge"><?php echo ucfirst($_GET['user'] ?? 'Utilisateur'); ?></span>
                        </div>
                        <button class="edit-btn">Modifier mes infos</button>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="card-header">
                        <img src="assets/images/menu/header/header-icone-2.png" alt="Icone Activité">
                        <h2>Mon Activité</h2>
                    </div>
                    <div class="card-content activity">
                        <div class="stat-mini">
                            <span class="number">12</span>
                            <span class="label">Candidatures</span>
                        </div>
                        <div class="stat-mini">
                            <span class="number">5</span>
                            <span class="label">Entreprises favorites</span>
                        </div>
                        <hr>
                        <p class="last-login">Dernière connexion : Aujourd'hui à 10:45</p>
                    </div>
                </div>
            </div>
        </main>


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