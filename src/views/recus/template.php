<?php
$today = date('Y-m-d');
$expired = empty($paiement['date_expiration'])
            || $paiement['date_expiration'] < $today;

// === LOGO BACKGROUND (WATERMARK) ===

// Sauvegarde position actuelle
$x = 35;     // position X (ajuste si besoin)
$y = 20;     // position Y
$w = 140;    // largeur du logo (GRAND)

// Logo très clair / transparent recommandé
$pdf->Image(
    __DIR__ . '/../../../public/photos/logo1.png',
    $x,
    $y,
    $w
);

// Revenir au-dessus du logo
$pdf->SetXY(10, 10);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, utf8_decode('FICHE DE PAIEMENT N°'.$paiement['numpayement']), 0, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 6, 'Date d\'impression : '.date('d/m/Y H:i:s'), 0, 1, 'C');

$pdf->Ln(8);

// ---------------- INFORMATIONS ----------------
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Informations', 0, 1);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(40, 6, 'Membre Payeur :');
// si le nom et prenom trop long, on peut les mettre sur 2 lignes
if (strlen($paiement['nom'].' '.$paiement['prenom']) > 35) {
    $pdf->Cell(80, 6, utf8_decode($paiement['nom'].' '.$paiement['prenom']), 0, 1);
} else {
    $pdf->Cell(80, 6, utf8_decode($paiement['nom'].' '.$paiement['prenom']));
}
$pdf->Cell(40, 6, 'Date de Paiement :');
$pdf->Cell(0, 6, utf8_decode($paiement['datepaiement']), 0, 1);

$pdf->Cell(40, 6, 'CIN :');
$pdf->Cell(80, 6, utf8_decode($paiement['cinpaiement']));

$pdf->SetFont('Arial', '', 10);
if ($paiement['type'] === 'cotisation'){
$pdf->Cell(40, 6,utf8_decode('Date d\'expiration : '));
$pdf->Cell(80, 6, utf8_decode($paiement['date_expiration']), 0, 1);
}
// Si le type de paiement est "cotisation", affiche Duree (mois) sinon n'affiche pas la ligne
if ($paiement['type'] === 'cotisation') {
$pdf->Cell(40, 6, 'Duree (mois) :');
$pdf->Cell(0, 6, utf8_decode($paiement['duree']), 0, 1);
}


$pdf->Cell(40, 6, 'Type de Paiement :');
$pdf->Cell(80, 6, strtoupper($paiement['type']));
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 60, 150);
if(!$expired){
$pdf->Cell(0, 8, 'Numero de carte : '.'   '.$paiement['numcart'], 0, 1);
}
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Status de paiement :');
$pdf->Cell(80, 6, utf8_decode(strtoupper($paiement['status'])));
$pdf->Ln(20);



// ---------------- DETAILS FINANCIERS ----------------
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Details Financiers', 0, 1);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(4);

$montantDu = $paiement['montant'];
$montantRecu = $paiement['montant_recu'];
$monnaie = $montantRecu - $montantDu;

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80, 8, 'Montant du (facture)', 1);
$pdf->Cell(40, 8, number_format($montantDu, 2, ',', ' ').' Ar', 1, 1, 'R');

$pdf->SetFillColor(220,230,255);
$pdf->Cell(80, 8, 'Montant recu (client)', 1, 0, '', true);
$pdf->Cell(40, 8, number_format($montantRecu, 2, ',', ' ').' Ar', 1, 1, 'R', true);

$pdf->SetFillColor(180,255,180);
$pdf->Cell(80, 8, 'Monnaie rendue', 1, 0, '', true);
$pdf->Cell(40, 8, number_format($monnaie, 2, ',', ' ').' Ar', 1, 1, 'R', true);

$pdf->Ln(15);

// ---------------- RESPONSABLE ----------------
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Responsable Enregistreur', 0, 1);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

$pdf->Ln(6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Enregistre par :');
$pdf->SetTextColor(0, 60, 150);
$pdf->Cell(0, 6, 'ROBIHASINA Nirina Korias');
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(20);
$pdf->Cell(0, 6, 'Fait a Votre Ville, le '.date('d/m/Y'), 0, 1);
$pdf->Ln(15);
$pdf->Cell(0, 6, 'Signature :', 0, 1, 'R');