<?php
require_once __DIR__ . '/../models/PaiementModel.php';
require_once __DIR__ . '/../models/ResponsableModel.php';
require_once __DIR__ . '/../../vendor/fpdf/fpdf.php';
class RecuController {

    public function pdf()
    {
        $conn = Database::compta();
        $id = $_GET['id'] ?? null;
        if (!$id) die("ID paiement manquant");

        $paiement = PaiementModel::getOneWithMembre($id);
        if (!$paiement) die("Paiement introuvable");

        $pdf = new FPDF();
        $pdf->AddPage('P', 'A4');
        $pdf->SetAutoPageBreak(false);

        $responsables = $conn->query("SELECT * FROM responsable")->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/recus/template.php';


        $pdf->Output(
            'I',
            'recu_paiement_'.$paiement['cinpaiement'].'.pdf'
        );
        exit;
    }
}