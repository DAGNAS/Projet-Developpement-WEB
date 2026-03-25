<?php 
namespace App\Controllers;

use App\Models\SecurityModel;

class AuthController extends Controller {

    public function __construct($templateEngine) {
        $this->SecurityModel = new SecurityModel();
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

        $_SESSION['user_role'] = $user;

        $champs = [
            ['name' => 'login', 'type' => 'text', 'placeholder' => 'Login'],
            ['name' => 'email', 'type' => 'email', 'placeholder' => 'Email'],
            ['name' => 'password', 'type' => 'password', 'placeholder' => 'Mot de passe']
        ];
        
        echo $this->templateEngine->render('auth/Login.twig.html', ['type_user' => $user, 'champs' => $champs]);
    }

    public function submitLogin() {

        if(!isset($_POST['login'])) {
            header('Location: ?uri=login');
            return;
        }

        if($this->SecurityModel->authenticate($_POST['login'],$_POST['email'], $_POST['password'])) {
            header('Location: ?uri=search');
        } else {
            header('Location: ?uri=login');
        }

    }
}


?>