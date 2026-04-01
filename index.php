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

    default:
        echo '404 Not Found';
        break;
}