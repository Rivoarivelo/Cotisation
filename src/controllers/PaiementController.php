<?php
require_once __DIR__ . '/../models/PaiementModel.php';
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../config/role_responsable.php';
require_once __DIR__ . "/../models/SortieFondModele.php";
require_once __DIR__ . '/../models/ResponsableModel.php';


class PaiementController {

  public function index() {
    $conn = Database::compta();
    $model = new SortieFondModele($conn);
    if (!empty($_GET['search'])) {
        $payements = PaiementModel::search($_GET['search']);
    } else {
        $payements = PaiementModel::getWithMembre();
    }

    // Statistiques
    $statsByDate = PaiementModel::statsByDate();

    $statsGlobal = PaiementModel::statsGlobal();

    // Totaux financiers
    $totalSortie = $model->totalSortie();
    $totalEntree = $model->totalEntree();

    $soldeRestant = $totalEntree - $totalSortie;
    $responsables = $conn->query("SELECT * FROM responsable")->fetchAll(PDO::FETCH_ASSOC);

    // require __DIR__ . '/../views/paiements/index.php';
    $view = __DIR__ . '/../views/paiements/index.php';
    require __DIR__ . '/../views/layout/dashboard.php';
}

    public function add() {

        // 1️⃣ Charger les membres pour le select
        $membres = MembreModel::getForSelect();
        $responsables = ResponsableModel::getAll();

        // 2️⃣ Si formulaire soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $montant = (int) $_POST['montant'];

        // ❌ Montant invalide
        if ($montant < 1000 || $montant % 1000 !== 0) {
            $_SESSION['error'] = "Montant indisponible. Utilisez 1000, 2000, 3000...";
            header("Location: index.php?controller=paiement&action=add");
            exit;
        }

        $duree = $montant / 1000;

            PaiementModel::insert([
                $_POST['type'],
                $duree,
                $_POST['montant'],
                $_POST['status'],
                $cin = $_POST['cinpaiement'],
                $_POST['montant_recu']
            ]);

            // 🎫 Générer carte seulement si paiement cotisation
            if ($_POST['type'] === 'cotisation' && $_POST['status'] === 'payé') {
                MembreModel::generateCarteIfNotExists($cin);
            }

           // expiration seulement pour cotisation
        if ($_POST['type'] === 'cotisation') {
            PaiementModel::updateExpiration($_POST['cinpaiement'], $duree);
        }

            header("Location: index.php?controller=paiement");
            exit;
        }

        // require __DIR__ . '/../views/paiements/add.php';
        $title = "Ajouter paiement" ;
        $view = __DIR__ . '/../views/paiements/add.php';
        require __DIR__ . '/../views/layout/dashboard.php';

    }

    public function stats()
    {
    $month = $_GET['month'] ?? date('m');
    $year  = $_GET['year'] ?? date('Y');

    $statsByType = PaiementModel::statsByType();
    $statsByDate = PaiementModel::statsByDate();

    $statsGlobal = PaiementModel::statsGlobal();

    //  NOUVEAU — utilisateurs
    $statsProfession = MembreModel::statsByProfession();
    $statsRegion     = MembreModel::statsByRegion();

    // Stat Genre
    $statsGenre = MembreModel::statsByGenre();


    // require __DIR__ . '/../views/paiements/stats.php';
    $view = __DIR__ . '/../views/paiements/stats.php';
    require __DIR__ . '/../views/layout/dashboard.php';
    }

}