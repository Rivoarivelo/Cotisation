<?php
require_once __DIR__ . '/../models/PaiementModel.php';
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . "/../models/SortieFondModele.php";
require_once __DIR__ . "/../models/ResponsableModel.php";
require_once __DIR__ . '/../models/ActiviteModel.php';
require_once __DIR__ . '/../models/FinanceModel.php';

class DashboardController
{
    public function index()
    {
        $totalPaiements = PaiementModel::total();
        $totalMembres   = MembreModel::count();
        $totalResponsable = ResponsableModel::countResponsable();

        // $conn = Database::compta();
        // $model = new SortieFondModele($conn);

        // // Totaux financiers
        // $totalSortie = $model->totalSortie();
        // $totalEntree = $model->totalEntree();

        // $soldeRestant = $totalEntree - $totalSortie;
        // $solde = $model->soldeRestant();

        $totalSortie = FinanceModel::totalSortie();
        $totalEntree = FinanceModel::totalEntree();
        $solde       = FinanceModel::solde();

      $regionsActives =  MembreModel::regionsPlusActives();

        // ===== 📈 Evolution financière =====
        $evolution = PaiementModel::evolutionMensuelle();

        // ===== 🕒 Activités récentes =====
        $activites = ActiviteModel::recent();


        // require __DIR__ . '/../views/dashboard/accueil.php';
        $view = __DIR__ . '/../views/dashboard/accueil.php';
        $title = __DIR__ ."Accueil";
        require __DIR__ . '/../views/layout/dashboard.php';
    }
}