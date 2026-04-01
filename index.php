<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start([
'cookie_httponly' => true,
'cookie_secure' => false,
'cookie_samesite' => 'Strict',
]);

require "vendor/autoload.php";

use App\Controllers\AuthController;
use App\Controllers\UsersController;
use App\Controllers\MyAccountController;

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
$MyAccountController = new MyAccountController($twig);

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

    case 'view_offer':
        $UsersController->ViewOfferPage();
        break;

    // --- ROUTES PROFIL --- //
    case 'profile':                 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MyAccountController->UpdatePassword();
        } else {
            $MyAccountController->MyAccountPage();
        }
        break;
    
    case 'profile/toggle_notif':
         $MyAccountController->ToggleNotif();

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
    case 'students':
    $controller->MyStudentPage();
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