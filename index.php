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
    // GLOBAL
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
    
    case 'profile':
        $UsersController->MyAccountPage();
        break;

    default:
        echo '404 Not Found';
        break;
}