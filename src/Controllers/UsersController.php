<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\SearchModel;

class UsersController extends Controller {

    public function __construct($templateEngine) {
        $this->UsersModel = new UsersModel();
        $this->SearchModel = new SearchModel();
        $this->templateEngine = $templateEngine;
    }

    public function Dashboard() {
        $user = $_SESSION['user_role'];
        return $this->UsersModel->getNavLinks($user);
    }

    public function SearchPage() {
        $nav = $this->Dashboard();
        $companies = $this->SearchModel->ListAllCompany();
        echo $this->templateEngine->render('common/Search.twig.html', ['nav' => $nav, 'companies' => $companies]);
    }
    
    public function MyAccountPage() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $action = $_GET['action'] ?? null;
        echo $this->templateEngine->render('common/MyAccount.twig.html', [
            'nav'          => $this->Dashboard(),
            'userInfo'     => $this->UsersModel->getUserInfo($_SESSION['user_id']),
            'editPassword' => ($action === 'editPassword'), // Vrai si ?action=editPassword
            'stats'        => ['applications' => 5, 'favorites' => 1, 'saved_offers' => 2],
            'activities'   => []
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

    public function MyWishListPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('student/MyWishlist.twig.html', ['nav' => $nav]);
    }

    public function MyApplicationsPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('student/MyApplications.twig.html', ['nav' => $nav]);
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
        session_destroy();
        header('Location: index.php?uri=/');
    }
}

?>
