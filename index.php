<?php
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

$uri = $_GET['uri'] ?? '/';

$AuthController = new AuthController($twig);
$UsersController = new UsersController($twig);
$MyAccountController = new MyAccountController($twig);

switch ($uri) {
    case '/':
        $AuthController->HomePage();
        break;

    case 'login':
        $AuthController->LoginPage();
        break;

    case 'submit_login':
        $AuthController->submitLogin();
        break;

    // Changement de profile
    case 'autoLogin':

        if (!isset($_GET['type'])) {
            header('Location: ?uri=/');
            exit;
        }

        $type = $_GET['type'];
        $allowedRoles = ['admin', 'company', 'pilote', 'student'];

        if (!in_array($type, $allowedRoles)) {
            die('Rôle invalide');
        }

        $_SESSION['user_role'] = $type;
        $_SESSION['is_logged'] = true;

        header('Location: ?uri=search');
        exit;

    // SPECIFIED
    case 'search':
        $UsersController->SearchPage();
        break;

    case 'view_offer':
        $UsersController->ViewOfferPage();
        break;

    case 'apply':
        $UsersController->ApplyOffer();
        break;

    case 'submit_application':
        $UsersController->SubmitApplication();
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

    case 'create-offer':
        $UsersController->CreateOfferPage();
        break;

    case 'store-offer':
        $UsersController->StoreOffer();
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
    case 'students':
    $UsersController->MyStudentPage();
        break;

    case 'edit-offer':
    $UsersController->EditOfferPage();
    break;

    case 'update-offer':
        $UsersController->UpdateOffer();
        break;

    case 'delete-offer':
        $UsersController->DeleteOffer();
        break;
    case 'change-account':
        $UsersController->ChangeAccountPage();
        break;
    case 'create-account':
        $UsersController->CreateAccountPage();
        break;
    case 'students':
    $UsersController->MyStudentPage();
        break;

    default:
        echo '404 Not Found';
        break;

}