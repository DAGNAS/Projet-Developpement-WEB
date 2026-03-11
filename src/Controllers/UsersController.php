<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UsersController extends Controller {

    public function __construct($templateEngine) {
        $this->model = new UsersModel();
        $this->templateEngine = $templateEngine;
    }

    public function Dashboard() {
        session_start();
        $user = $_SESSION['user_role'];

        $navLinks = $this->model->getNavLinks($user);
        return [
            'liste_page' => array_column($navLinks, 'lien'),
            'liste_nom_page' => array_column($navLinks, 'nom'),
        ];
    }

    public function SearchPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('common/Search.twig.html', $nav);
    }
    
    public function MyAccountPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('common/MyAccount.twig.html', $nav);
    }

    public function MyWishListPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('student/MyWishlist.twig.html', $nav);
    }

    public function MyApplicationsPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('student/MyApplications.twig.html', $nav);
    }

    public function MyStudentPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('pilote/MyStudent.twig.html', $nav);
    }

    public function MyPostPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('company/MyPost.twig.html', $nav);
    }

    public function SystemInfoPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('admin/SystemInfo.twig.html', $nav);
    }

    public function LegalMentionPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('common/LegalMention.twig.html', $nav);
    }

    public function Logout() {
        session_start();
        session_destroy();
        header('Location: index.php?uri=/');
    }
}

?>