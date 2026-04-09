<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\JobApplicationModel;
use App\Models\SearchModel;
use DateTime;

class UsersController extends Controller {
    private $SQLDatabase;
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

    public function ApplyOffer() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $nav = $this->Dashboard();
        echo $this->templateEngine->render('student/Apply.twig.html', [
            'nav' => $nav,
            'user' => $this->UsersModel->getUserInfo($_SESSION['user_id'])
        ]);
    }

    public function SubmitApplication() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $this->JobApplicationModel->SubmitApplication([
            'id_user' => $_SESSION['user_id'],
            'id_offer' => $_GET['id_offer'],
            'cover_letter' => $_GET['cover_letter']
        ]);

        $this->ApplyOffer();
    }

    public function MyPostPage() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $nav = $this->Dashboard();
        $userEmail = $_SESSION['user_id'] ?? null;
        if (!$userEmail) {
            header('Location: ?uri=login');
            exit;
        }

        $company = $this->UsersModel->getCompanyByUserEmail($userEmail);
        if (!$company) {
            die("Entreprise introuvable.");
        }

        $page = $_GET['page'] ?? 1;
        $page = (int)$page;
        if ($page < 1) {
            $page = 1;
        }

        $limit = 8;
        $offset = ($page - 1) * $limit;
        $offers = $this->UsersModel->getOffersPaginatedByCompany($company['id'], $limit, $offset);
        $total = $this->UsersModel->countOffersByCompany($company['id'])['total'];
        $totalPages = (int) ceil($total / $limit);

        if ($totalPages < 1) {
            $totalPages = 1;
        }
        if ($page > $totalPages) {
            $page = $totalPages;
        }

        echo $this->templateEngine->render('company/MyPost.twig.html', [
            'nav' => $nav,
            'offers' => $offers,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }


    public function MyStudentPage() {
        $nav = $this->Dashboard();

        $students = $this->SearchModel->getAllStudents();

        echo $this->templateEngine->render('pilote/MyStudent.twig.html', [
            'nav' => $nav,
            'students' => $students
        ]);
    }

    public function toggleWishlist() {
        $data = json_decode(file_get_contents("php://input"), true);

        $profileId = 1;
        $offreId = $data['offre_id'];

        $this->SearchModel->toggleWishlist($profileId, $offreId);

        echo json_encode(['status' => 'ok']);
    }

    public function MyWishListPage() {
        $profileId = 1; // temporaire
        $offers = $this->SearchModel->getWishlistOffers($profileId);
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('student/MyWishlist.twig.html', [
            'nav' => $nav,
            'JobApplication' => $offers
        ]);
    }

    public function StudentWishlistPage() {

        $studentId = $_GET['id'];
        $profileId = 1; // temporaire
        $offers = $this->SearchModel->getWishlistOffers($profileId);

        $student = $this->SearchModel->getStudentById($studentId);
        $nav = $this->Dashboard();

        echo $this->templateEngine->render('student/MyWishlist.twig.html', [
            'nav' => $nav,
            'JobApplication' => $offers,
            'student' => $student
        ]);
    }

    public function CreateOfferPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('company/CreateOffer.twig.html', ['nav' => $nav]);
    }

    public function EditOfferPage() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userEmail = $_SESSION['user_id'] ?? null;
        $id = $_GET['id'] ?? null;
        if (!$userEmail || !$id) {
            die("Accès refusé.");
        }
        $company = $this->UsersModel->getCompanyByUserEmail($userEmail);
        if (!$company) {
            die("Entreprise introuvable.");
        }
        $offer = $this->UsersModel->getOfferByIdAndCompany($id, $company['id']);
        if (!$offer) {
            die("Cette offre ne vous appartient pas.");
        }

        $nav = $this->Dashboard();
        echo $this->templateEngine->render('company/EditOffer.twig.html', [
            'nav' => $nav,
            'offer' => $offer
        ]);
    }

    public function UpdateOffer() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?uri=my-posts');
            exit;
        }
        $userEmail = $_SESSION['user_id'] ?? null;
        if (!$userEmail) {
            die("Accès refusé.");
        }
        $company = $this->UsersModel->getCompanyByUserEmail($userEmail);
        if (!$company) {
            die("Entreprise introuvable.");
        }
        $id = $_POST['id'] ?? null;
        $title = trim($_POST['title'] ?? '');
        $sector = trim($_POST['sector'] ?? '');
        $type = trim($_POST['type'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $location = trim($_POST['location'] ?? '');
        if (!$id || !$title || !$sector || !$type || !$description || !$location) {
            die("Tous les champs sont obligatoires.");
        }
        $offer = $this->UsersModel->getOfferByIdAndCompany($id, $company['id']);
        if (!$offer) {
            die("Cette offre ne vous appartient pas.");
        }
        $this->UsersModel->updateOffer(
            $id,
            $title,
            $sector,
            $type,
            $description,
            $location
        );
        header('Location: ?uri=my-posts');
        exit;
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
        exit;
    }

    public function StoreOffer() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header('Location: ?uri=create-offer');

            exit;

        }

        $userEmail = $_SESSION['user_id'] ?? null;

        if (!$userEmail) {
            header('Location: ?uri=login');
            exit;
        }

        $company = $this->UsersModel->getCompanyByUserEmail($userEmail);
        if (!$company) {
            die("Aucune entreprise trouvée.");
        }

        $title = trim($_POST['title'] ?? '');
        $sector = trim($_POST['sector'] ?? '');
        $type = trim($_POST['type'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $location = trim($_POST['location'] ?? '');

        if (!$title || !$sector || !$type || !$description || !$location) {
            die("Tous les champs sont obligatoires.");
        }

        $this->UsersModel->createOffer(
            $company['id'],
            $title,
            $sector,
            $type,
            $description,
            $location
        );

        header('Location: ?uri=my-posts');
        exit;
    }

    public function DeleteOffer() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userEmail = $_SESSION['user_id'] ?? null;
        $id = $_GET['id'] ?? null;
        if (!$userEmail || !$id) {
            die("Accès refusé.");
        }

        $company = $this->UsersModel->getCompanyByUserEmail($userEmail);
        if (!$company) {
            die("Entreprise introuvable.");
        }

        $offer = $this->UsersModel->getOfferByIdAndCompany($id, $company['id']);
        if (!$offer) {
            die("Cette offre ne vous appartient pas.");
        }

        $this->UsersModel->deleteOfferByCompany($id, $company['id']);

        header('Location: ?uri=my-posts');
        exit;
    }
    public function ChangeAccountPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('admin/ChangeAccount.twig.html', ['nav' => $nav]);
    }

    public function CreateAccountPage() {
        $nav = $this->Dashboard();
        echo $this->templateEngine->render('admin/CreateAccount.twig.html', ['nav' => $nav]);
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

}