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