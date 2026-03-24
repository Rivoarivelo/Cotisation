<?php
/* ===== FOND ===== */
$pdf->SetFillColor(11, 26, 61);
$pdf->Rect(0,0,86,54,'F');

/* ===== LOGO ===== */
// $logo = __DIR__ . '/../../../public/photos/logo.png';
// if(file_exists($logo)){
//     $pdf->Image($logo,4,4,12);
// }

$x = 0;     // position X (ajuste si besoin)
$y = 0;     // position Y
$w = 90;    // largeur du logo (GRAND)

// Logo très clair / transparent recommandé
$pdf->Image(
    __DIR__ . '/../../../public/photos/serp.png',
    $x,
    $y,
    $w
);

/* ===== TITRE ===== */
$pdf->SetTextColor(255,255,0);
$pdf->SetFont('Arial','B',11);
$pdf->SetXY(6,4);
$pdf->Cell(60,6,$membre['nom'].' '. $membre['prenom']);

/* ===== PHOTO ===== */

$photo = __DIR__ . '/../../../public/uploads/'.$membre['photo'];


if(!empty($membre['photo']) && file_exists($photo)){
    $pdf->Image($photo,60,10,22,26);
}

/* ===== INFOS MEMBRE ===== */
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','',8);

// $pdf->SetXY(6,18);
// $pdf->Cell(50,4,$membre['nom']);

// $pdf->SetXY(6,23);
// $pdf->Cell(50,4,$membre['prenom']);
$pdf->SetTextColor(255,255,0);
$pdf->SetFont('Arial','B',5);
$pdf->SetXY(6,10);
$pdf->Cell(70,2,utf8_decode($membre['profession']));



$pdf->SetXY(6,44);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(50,4,utf8_decode('0'.$membre['contact']));

$pdf->SetXY(47,45);
$pdf->Cell(50,4,utf8_decode($membre['email']));

$pdf->SetXY(64,40);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(50,4,utf8_decode($membre['numcart']));