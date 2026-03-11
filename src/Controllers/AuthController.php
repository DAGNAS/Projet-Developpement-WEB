<?php 
namespace App\Controllers;

use App\Models\SecurityModel;

class AuthController extends Controller {

    public function __construct($templateEngine) {
        $this->model = new SecurityModel();
        $this->templateEngine = $templateEngine;
    }

    public function HomePage() {
        echo $this->templateEngine->render('common/HomePage.twig.html');
    }

    public function LegalMentionPage() {
        echo $this->templateEngine->render('common/LegalMention.twig.html');
    }

    public function LoginPage() {
        if(!isset($_POST['login'])) {
            header('Location: ?uri=/');
            return;
        }

        $user = $_POST['login'];

        session_start();
        $_SESSION['user_role'] = $user;

        switch ($user) {
            case 'admin':
                $champs = [
                    ['name' => 'login', 'type' => 'text', 'placeholder' => 'Login'],
                    ['name' => 'password', 'type' => 'password', 'placeholder' => 'Mot de passe']
                ];
                break;

            case 'company':
                $champs = [
                    ['name' => 'login', 'type' => 'text', 'placeholder' => 'Login'],
                    ['name' => 'email', 'type' => 'email', 'placeholder' => 'Email'],
                    ['name' => 'password', 'type' => 'password', 'placeholder' => 'Mot de passe']
                ];
                break;

            case 'pilote':
                $champs = [
                    ['name' => 'login', 'type' => 'text', 'placeholder' => 'Login'],
                    ['name' => 'email', 'type' => 'email', 'placeholder' => 'Email'],
                    ['name' => 'password', 'type' => 'password', 'placeholder' => 'Mot de passe']
                ];
                break;

            case 'student':
                $champs = [
                    ['name' => 'login', 'type' => 'text', 'placeholder' => 'Login'],
                    ['name' => 'pilote', 'type' => 'text', 'placeholder' => 'Pilote'],
                    ['name' => 'password', 'type' => 'password', 'placeholder' => 'Mot de passe']
                ];
                break;

            default:
                header('Location: ?uri=/');
                return;
        }
        echo $this->templateEngine->render('auth/Login.twig.html', ['type_user' => $user, 'champs' => $champs]);
    }

    public function submitLogin() {

        if(!isset($_POST['login'])) {
            header('Location: ?uri=login');
            return;
        }

        if($this->model->authenticate($_POST['login'], $_POST['password'])) {
            header('Location: ?uri=search');
        } else {
            header('Location: ?uri=login');
        }

    }
}


?>