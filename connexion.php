<?php

$champs_nom = 
'<div class="input-group"> 
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
</div>';

$champs_pilote = 
'<div class="input-group">
    <label for="pilote">Votre Pilote</label>
    <input type="text" id="pilote" name="pilote" placeholder="Votre pilote" required>
</div>';

$champs_mail = 
'<div class="input-group">
    <label for="mail">Adresse e-mail</label>
    <input type="email" id="mail" name="mail" placeholder="votre@email.com" required>
</div>';

$champs_password1 = 
'<div class="input-group">
    <label for="password1">Mot de passe n°1</label>
    <input type="password" id="password1" name="password1" placeholder="••••••••" required>
</div>';

$champs_password2 = 
'<div class="input-group">
    <label for="password2">Mot de passe n°2</label>
    <input type="password" id="password2" name="password2" placeholder="••••••••" required>
</div>';

$error_msg = '';


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user = $_GET["user"];

    if ($user == "admin") {
        $list_champs = ["nom" => $champs_nom, "password1" => $champs_password1, "password2" => $champs_password2];
    }
    if ($user == "entreprise") {
        $list_champs = ["nom" => $champs_nom, "mail" => $champs_mail, "password" => $champs_password1];
    }
    if ($user == "pilote") {
        $list_champs = ["nom" => $champs_nom, "mail" => $champs_mail, "password" => $champs_password1];
    }
    if ($user == "etudiant") {
        $list_champs = ["nom" => $champs_nom, "pilote" => $champs_pilote, "password" => $champs_password1];
    }

    if (isset($_GET["error"])) {
        $error_msg = "Identifiants incorrects. Veuillez réessayer.";
    }
}

?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion - Job's Horizon</title>
        <link rel="stylesheet" href="assets/style/global/base.css">
        <link rel="stylesheet" href="assets/style/global/layout.css">
        <link rel="stylesheet" href="assets/style/global/components.css">
        <link rel="stylesheet" href="assets/style/pages/login-page.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header>
            <img class="logo-image" src="assets/images/menu/header/Logo-header.png" alt="Logo">
            <img class="header-icone" src="assets/images/menu/header/header-icone-1.png" alt="icone 1">
            <img class="header-icone" src="assets/images/menu/header/header-icone-2.png" alt="icone 2">
            <img class="header-icone" src="assets/images/menu/header/header-icone-3.png" alt="icone 3">
            <a class="header-btn" href="homepage.html">Menu</a>
        </header>

        <section class="login-container">
            <div class="login-form-box">
                <h2><?php echo 'Connexion ' . $user; ?></h2>
                <form action="verif.php?user=<?php echo $user; ?>" method="POST">

                    <?php foreach ($list_champs as $champ) {
                        echo $champ;
                    } 
                    if (!empty($error_msg)) {
                        echo '<p class="error-message">' . $error_msg . '</p>';
                    } ?>

                    <button type="submit" class="submit-btn">Se connecter</button>
                    
                    <div class="form-footer">
                        <a href="#">Mot de passe oublié / Pas encore de compte</a>
                    </div>
                </form>
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
                        <li><a href="mention-legales.html">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>