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