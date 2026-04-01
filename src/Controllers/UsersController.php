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

    public function SearchPage() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_GET['reset']) && $_GET['reset'] === '1') {
            $_SESSION['search_query'] = '';
            $_SESSION['search_location'] = '';
            $_SESSION['search_sector'] = '';
            $_SESSION['search_type'] = '';
            $_SESSION['current_page'] = 1;
        } else {
            $_SESSION['search_query'] = $_GET['q'] ?? $_SESSION['search_query'] ?? '';
            $_SESSION['search_location'] = $_GET['loc'] ?? $_SESSION['search_location'] ?? '';
            $_SESSION['search_sector'] = $_GET['cat'] ?? $_SESSION['search_sector'] ?? '';
            $_SESSION['search_type'] = $_GET['type'] ?? $_SESSION['search_type'] ?? '';
            $_SESSION['current_page'] = $_GET['page'] ?? $_SESSION['current_page'] ?? 1;
        }

        $page = $_GET['page'] ?? $_SESSION['current_page'];
        $page = (int)$page;

        $limit = 8;
        $offset = ($page - 1) * $limit;

        $personalQuery = $this->SearchModel->PersonalQuery(
            $_SESSION['search_query'], $_SESSION['search_location'], $_SESSION['search_sector'], $_SESSION['search_type'],
            $limit, $offset
        );

        $total = $personalQuery['count'];
        $totalPages = ceil($total / $limit);

        $nav = $this->Dashboard();
        echo $this->templateEngine->render('common/Search.twig.html', [
            'nav' => $nav,
            'JobApplication' => $personalQuery['query'],
            'query' => $_SESSION['search_query'],
            'location' => $_SESSION['search_location'],
            'category' => $_SESSION['search_sector'],
            'type' => $_SESSION['search_type'],
            'page' => $page,
            'totalPages' => $totalPages
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

    public function ViewOfferPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('common/JobView.twig.html', [
            'nav' => $nav,
            'offer' => $this->JobApplicationModel->GetOfferById($_GET['id'])
        ]);
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
    public function MyStudentPage() {

    $nav = $this->Dashboard();

    $students = $this->SearchModel->getAllStudents();

    echo $this->templateEngine->render('pilote/MyStudent.twig.html', [
        'nav' => $nav,
        'students' => $students
    ]);
    }
    public function ChangeAccountPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('admin/ChangeAccount.twig.html', ['nav' => $nav]);
    }

    public function CreateAccountPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('admin/CreateAccount.twig.html', ['nav' => $nav]);
    }
}

?>
