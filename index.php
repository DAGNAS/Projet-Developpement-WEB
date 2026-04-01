<?php
session_start([
'cookie_httponly' => true, // Protection contre le vol de session via JS (XSS)
'cookie_secure' => false, // Mettre à 'true' si vous utilisez HTTPS
'cookie_samesite' => 'Strict', // Protection contre les attaques CSRF
]);

require "vendor/autoload.php";

use App\Controllers\AuthController;
use App\Controllers\UsersController;

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

if (isset($_GET['uri'])) {
    $uri = $_GET['uri'];
} else {
    $uri = '/';
}


$AuthController = new AuthController($twig);
$UsersController = new UsersController($twig);

switch ($uri) {
    // CONNEXION
    case '/':
        $AuthController->HomePage();
        break;
    case 'login':
        $AuthController->LoginPage();
        break;
    case 'submit_login':
        $AuthController->submitLogin();
        break;

    // SPECIFIED
    case 'search':
        $UsersController->SearchPage();
        break;

    // --- ROUTES PROFIL --- //
    case 'profile':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $UsersController->UpdatePassword();
        } else {
            $UsersController->MyAccountPage();
        }
        break;

    case 'profile/toggle_notif':
         $UsersController->ToggleNotif();
         break;
    case 'wishlist':
        $UsersController->MyWishListPage();
        break;
    case 'applications':
        $UsersController->MyApplicationsPage();
        break;
    case 'my-students':
        $UsersController->MyStudentPage();
        break;
    case 'my-posts':
        $UsersController->MyPostPage();
        break;
    case 'system':
        $UsersController->SystemInfoPage();
        break;
    case 'legal-mentions':
        $UsersController->LegalMentionPage();
        break;
    case 'logout':
        $UsersController->Logout();
        break;
    case 'change-account':
        $UsersController->ChangeAccountPage();
        break;
    case 'create-account':
        $UsersController->CreateAccountPage();
        break;

    default:
        echo '404 Not Found';
        break;
}


if (isset($_GET['uri']) && $_GET['uri'] === 'autoLogin') {

    $type = $_GET['type'] ?? null;

    // Choix d’un utilisateur par défaut selon le rôle
    switch ($type) {
        case 'admin':
            $email = "admin@cesi.fr";
            break;

        case 'company':
            $email = "company@cesi.fr";
            break;

        case 'pilote':
            $email = "pilote@cesi.fr";
            break;

        case 'student':
            $email = "student@cesi.fr";
            break;

        default:
            die("Profil inconnu.");
    }

    // Charger cet utilisateur dans ta base
    $user = $UsersController->getUserByEmail($email);

    if (!$user) {
        die("Utilisateur introuvable en base : $email");
    }

    // Connexion
    $_SESSION['user'] = $user;

    // Redirection à son dashboard
    header("Location: index.php?uri=dashboard");
    exit;
}