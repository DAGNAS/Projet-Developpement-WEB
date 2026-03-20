<?php
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
    case 'profile':                 $UsersController->MyAccountPage(); break;
    case 'profile/info_edit':       $UsersController->EditInfo(); break;
    case 'profile/info_update':     $UsersController->UpdateInfo(); break;
    case 'profile/password_edit':   $UsersController->EditPassword(); break;
    case 'profile/password_update': $UsersController->UpdatePassword(); break;

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

    default:
        echo '404 Not Found';
        break;
}