<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\JobApplicationModel;
use App\Models\SearchModel;
use DateTime;

class UsersController extends Controller {

    public function __construct($templateEngine) {
        $this->UsersModel = new UsersModel();
        $this->JobApplicationModel = new JobApplicationModel();
        $this->SearchModel = new SearchModel();
        $this->templateEngine = $templateEngine;
    }

    public function Dashboard() {
        $user = $_SESSION['user_role'];
        return $this->UsersModel->getNavLinks($user);
    }

    public function SearchPage() {
        
        $page = $_GET['page'] ?? 1;
        $page = (int)$page;

        $limit = 8;
        $offset = ($page - 1) * $limit;

        $total = $this->SearchModel->countJobApplication();
        $totalPages = ceil($total / $limit);
    
        $nav = $this->Dashboard();
        $JobApplication = $this->SearchModel->getAllJobApplicationPaginated($limit, $offset);
        echo $this->templateEngine->render('common/Search.twig.html', ['nav' => $nav, 'JobApplication' => $JobApplication, 'page' => $page,
        'totalPages' => $totalPages]);
    }
    
    public function MyAccountPage() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userInfo = $this->UsersModel->getUserInfo($_SESSION['user_id']);

        $passwordMessage = null;
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success'){
                $passwordMessage = ['type' => 'success', 'text' => 'Mot de passe mis à jour !'];
            } else {
                $passwordMessage = ['type' => 'error', 'text' => 'Mot de passe non identique'];
            }
        }

        $mois = ["", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
        $date_brute = new DateTime($userInfo['date_login']);
        $num_mois = $date_brute->format('n'); // Récupère le numéro du mois sans le zéro

        $date_fr = $date_brute->format('d ') . $mois[$num_mois] . $date_brute->format(' Y à H:i');

        $action = $_GET['action'] ?? null;
        echo $this->templateEngine->render('common/MyAccount.twig.html', [
            'nav'               => $this->Dashboard(),
            'userInfo'          => $userInfo,
            'editPassword'      => ($action === 'editPassword'), // Vrai si ?action=editPassword
            'passwordMessage'   => $passwordMessage,
            'stats'             => ['applications' => 5, 'favorites' => 1, 'saved_offers' => 2],
            'activities'        => [],
            'last_login_fr'     => $date_fr
        ]);
    }

    public function UpdatePassword() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            isset($_POST['new_password'], $_POST['confirm_password'], $_SESSION['user_id']) &&
            $_POST['new_password'] === $_POST['confirm_password']
        ) {
            $this->UsersModel->updatePassword([
                'email' => $_SESSION['user_id'],
                'password' => $_POST['new_password']
            ]);
        }

        header('Location: ?uri=profile');
        exit;
    }

    public function ToggleNotif() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_SESSION['user_id'])) {
            // On demande au modèle d'inverser le statut actuel
            $this->UsersModel->toggleEmailNotifications($_SESSION['user_id']);
        }

        header('Location: ?uri=profile');
        exit;
    }

    public function MyWishListPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('student/MyWishlist.twig.html', ['nav' => $nav]);
    }

    public function MyApplicationsPage() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $nav = $this->Dashboard();
        $application = $this->JobApplicationModel->GetAllApplicationByMail($_SESSION['user_id']);
        echo $this->templateEngine->render('student/MyApplications.twig.html', ['nav' => $nav, 'application' => $application]);
    }

    public function MyStudentPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('pilote/MyStudent.twig.html', ['nav' => $nav]);
    }

    public function MyPostPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('company/MyPost.twig.html', ['nav' => $nav]);
    }

    public function SystemInfoPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('admin/SystemInfo.twig.html', ['nav' => $nav]);
    }

    public function LegalMentionPage() {
        echo $this->templateEngine->render('common/LegalMention.twig.html');
    }

    public function Logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->UsersModel->SaveTimeLastConnexion($_SESSION['user_id']);
        session_destroy();
        header('Location: index.php?uri=/');
    }
}

?>
