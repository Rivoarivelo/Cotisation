<?php
// 🎨 Fond principal
$pdf->SetFillColor(25, 64, 140); // bleu pro
$pdf->Rect(0, 0, 86, 54, 'F');

// 🧾 Carte blanche centrale
$pdf->SetFillColor(255, 255, 255);
$pdf->Rect(2, 2, 82, 50, 'F');

// 🔰 LOGO
$logo = __DIR__ . '/../../../public/photos/logo.jpg';
if (file_exists($logo)) {
    $pdf->Image($logo, 4, 2, 10);
}

// 🏷️ Nom organisation
$pdf->SetXY(25, 6);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 5, 'ASSOCIATION SARTM', 0, 1);

// 📷 PHOTO MEMBRE
$photoPath = __DIR__ . '/../../../public/uploads/' . $membre['photo'];
if (!empty($membre['photo']) && file_exists($photoPath)) {
    $pdf->Image($photoPath, 4, 15, 18, 22);
}

// 👤 Infos membre
$pdf->SetXY(25, 14);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 4, 'Nom : ' . strtoupper($membre['nom']), 0, 1);
$pdf->SetX(25);
$pdf->Cell(0, 4, 'Prenom : ' . $membre['prenom'], 0, 1);
$pdf->SetX(25);
$pdf->Cell(0, 4, 'CIN : ' . $membre['CIN'], 0, 1);
$pdf->SetX(25);
$pdf->Cell(0, 4, 'N° Carte : ' . $membre['numcart'], 0, 1);

// 📅 Date
$pdf->SetXY(25, 42);
$pdf->SetFont('Arial', 'I', 7);
$pdf->Cell(0, 4, 'Valide depuis : ' . date('Y'), 0, 1);