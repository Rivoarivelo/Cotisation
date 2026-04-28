<?php

require_once __DIR__ . '/../models/PresenceModel.php';
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/PresenceTempModel.php';

class PresenceController
{

    public function index()
    {
        $view = __DIR__ . '/../views/presence/index.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    // appelé par QR code (AJAX)
    public function scan()
    {
        //BLOQUER toute sortie parasite
        ob_clean();
        header('Content-Type: application/json');

        try {

            $cin = $_GET['cin'] ?? null;

            if (!$cin) {
                echo json_encode(['error' => 'CIN manquant']);
                exit;
            }

            $membre = MembreModel::getByCIN($cin);

            if (!$membre) {
                echo json_encode(['error' => 'Membre introuvable']);
                exit;
            }

            echo json_encode($membre);
            exit;

        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }

    // VALIDER PRESENCE
    public function valider()
    {
        // header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $data = json_decode(file_get_contents("php://input"), true);

        $titre = $data['titre'];
        $date_event = $data['date_event'];
        $liste = $data['liste'];

        $_SESSION['presence_data'] = [
            'titre' => $titre,
            'date_event' => $date_event,
            'liste' => $liste
        ];

        foreach ($liste as $membre) {
            PresenceModel::enregistrer($membre, $titre, $date_event);
        }

        echo json_encode(['redirect' => 'index.php?controller=presence&action=liste']);
    }

    public function liste()
    {
        $data = $_SESSION['presence_data'] ?? null;

        if (!$data) {
            die("Aucune donnée");
        }

        $view = __DIR__ . '/../views/presence/liste.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function exportPDF()
    {
        require_once __DIR__ . '/../../vendor/fpdf/fpdf.php';
        $data = $_SESSION['presence_data'];

        $pdf = new FPDF();
        $pdf->AddPage();

        // LOGO transparent
        // Sauvegarde position actuelle
        $x = 35;     // position X (ajuste si besoin)
        $y = 20;     // position Y
        $w = 140;    // largeur du logo (GRAND)

        // Logo très clair / transparent recommandé
        $pdf->Image(
            __DIR__ . '/../../public/photos/logo1.png',
            $x,
            $y,
            $w
        );

        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(0, 10, 'FICHE DE PRESENCE', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Motif : ' . $data['titre'], 0, 1);
        $pdf->Cell(0, 10, 'Date : ' . $data['date_event'], 0, 1);

        $pdf->Ln(5);

        // TABLE HEADER
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, 'Nom', 1);
        $pdf->Cell(40, 10, 'Prenom', 1);
        $pdf->Cell(40, 10, 'Date', 1);
        $pdf->Cell(40, 10, 'Heure', 1);
        $pdf->Ln();

        // DATA
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['liste'] as $m) {
            $pdf->Cell(40, 10, $m['nom'], 1);
            $pdf->Cell(40, 10, $m['prenom'], 1);
            $pdf->Cell(40, 10, $m['date_event'], 1);
            $pdf->Cell(40, 10, $m['heure_scan'], 1);


            $pdf->Ln();
        }

        $pdf->Output();
    }


    // 🔴 récupérer en temps réel
    public function getTemp()
    {
        header('Content-Type: application/json');
        echo json_encode(PresenceTempModel::getEnAttente());
    }

    // ✅ valider présence
    public function validerTemp()
    {
        $id = $_POST['id'];

        PresenceTempModel::valider($id);

        echo json_encode(['success' => true]);
    }

    // ❌ rejeter
    public function rejeterTemp()
    {
        $id = $_POST['id'];

        PresenceTempModel::rejeter($id);

        echo json_encode(['success' => true]);
    }

    public function validerAll()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $titre = $data['titre'];
        $date_event = $data['date_event'];

        $membres = PresenceTempModel::getValide();

        foreach ($membres as $m) {

            PresenceModel::enregistrer([
                'CIN' => $m['cin'],
                'numcart' => $m['num_carte'],
                'nom' => $m['nom'],
                'prenom' => $m['prenom'],
                'heure_scan' => $m['heure_scan']
            ], $titre, $date_event);
        }

        PresenceTempModel::vider();


        $_SESSION['presence_data'] = [
            'titre' => $titre,
            'date_event' => $date_event,
            'liste' => $membres
        ];

        echo json_encode([
            'redirect' => 'index.php?controller=presence&action=liste'
        ]);


    }

    // HISTORIQUE
    public function historique()
{
    require_once __DIR__ . '/../models/PresenceModel.php';

    $date = $_GET['date'] ?? null;
    $titre = $_GET['titre'] ?? null;

    $data = PresenceModel::getHistorique($date, $titre);

    $view = __DIR__ . '/../views/presence/historique.php';
    require __DIR__ . '/../views/layout/dashboard.php';
}



}