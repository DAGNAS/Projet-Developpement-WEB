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
