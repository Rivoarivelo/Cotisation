<?php

$pdf->SetFillColor(11,26,61);
$pdf->Rect(0,0,86,54,'F');

$logo = __DIR__.'/../../../public/photos/logo.png';

if(file_exists($logo)){
    $pdf->Image($logo,18,0,50);
}

$pdf->SetTextColor(255,255,0);
$pdf->SetFont('Arial','B',12);

$pdf->SetXY(0,42);
$pdf->Cell(86,6,'SYNDICAT UNIS',0,1,'C');

/* QR CODE */

$qr = __DIR__.'/../../../public/qrcodes/'.$membre['CIN'].'.png';

if(file_exists($qr)){
    $pdf->Image($qr,65,30,18);
}